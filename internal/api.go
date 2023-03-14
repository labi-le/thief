package internal

import (
	"context"
	"fmt"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/api/cmdroute"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/diamondburned/arikawa/v3/utils/json/option"
	"github.com/hashicorp/go-multierror"
	"github.com/pkg/errors"
	"github.com/sirupsen/logrus"
	"reflect"
	"regexp"
	"strings"
	"thief/pkg/validator"
	"time"
)

type resource struct {
	*cmdroute.Router
	bot *state.State
	log *logrus.Logger

	self    *discord.User
	service UserService

	supportRoleID []SupportRoleID
	memberRoleID  []MemberRoleID
}

const (
	UserTag       = "user"
	AgeTag        = "age"
	NameTag       = "name"
	LocationTag   = "location"
	HobbiesTag    = "hobbies"
	OccupationTag = "occupation"
	GoalsTag      = "goals"
	KeywordTag    = "keyword"
)

var (
	ErrInvalidAge = errors.New("Некорректный возраст. Ожидаемый формат: число от 12 до 70")

	ErrNoAccess     = errors.New("У вас нет доступа к этой команде")
	ErrFormNotFound = errors.New("Анкета не найдена")
	ErrNotFound     = errors.New("По вашему запросу ничего не найдено")
)

var (
	nameField = validator.Field{
		Name:    "Имя",
		Tag:     NameTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ-]{1,50}$`),
		Example: "Анастасия",
	}

	locationField = validator.Field{
		Name:    "Город проживания",
		Tag:     LocationTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ]+(?:[ -][a-zA-Zа-яА-ЯёЁ]+)*$`),
		Example: "Екатеринбург",
	}

	hobbiesField = validator.Field{
		Name:    "Хобби",
		Tag:     HobbiesTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "рисование, игра на гитаре, видеоигры, anime",
	}

	occupationField = validator.Field{
		Name:    "Род деятельности",
		Tag:     OccupationTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "работаю",
	}

	goalsField = validator.Field{
		Name:    "Цели",
		Tag:     GoalsTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "познакомиться с новыми людьми",
	}

	keywordField = validator.Field{
		Name:    "Ключевые слова",
		Tag:     KeywordTag,
		Regexp:  regexp.MustCompile(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "общение",
	}
)

func RegisterHandlers(bot *state.State, logger *logrus.Logger, service UserService, conf Config) {
	me, err := bot.Me()
	if err != nil {
		panic(errors.Wrap(err, "failed to get self id"))
	}

	logger.Infof("%s is running", me.Username)

	res := &resource{
		bot:           bot,
		Router:        cmdroute.NewRouter(),
		log:           logger,
		self:          me,
		service:       service,
		supportRoleID: conf.SupportRoleID,
		memberRoleID:  conf.MemberRoleID,
	}

	bot.AddInteractionHandler(res)

	res.AddFunc("stats", res.Stats)
	res.AddFunc("help", res.Help)
	res.AddFunc("get", res.Get)
	res.AddFunc("search", res.Search)

	//res.Use(res.CheckAccess)
	res.AddFunc("set", res.Set)
	res.AddFunc("delete", res.Delete)

	if err := cmdroute.OverwriteCommands(bot, getInlineCommands()); err != nil {
		panic(errors.Wrap(err, "failed to overwrite commands"))
	}
}

func getInlineCommands() []api.CreateCommandData {
	return []api.CreateCommandData{
		{
			Name:        "set",
			Description: "Добавить анкету пользователя",

			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UserTag,
					Description: "Никнейм",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  NameTag,
					Description: "Имя",
					Required:    true,
				},

				&discord.IntegerOption{
					OptionName:  AgeTag,
					Description: "Возраст",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  LocationTag,
					Description: "Город проживания",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  HobbiesTag,
					Description: "Увлечения",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  OccupationTag,
					Description: "Род деятельности (учеба, работа)",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  GoalsTag,
					Description: "Цели",
					Required:    true,
				},
			},
		},

		{
			Name:        "get",
			Description: "Получить анкету пользователя",

			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UserTag,
					Description: "Никнейм",
					Required:    true,
				},
			},
		},

		{
			Name:        "search",
			Description: "Поиск анкеты пользователя по ключевым словам",

			Options: []discord.CommandOption{
				&discord.StringOption{
					OptionName:  KeywordTag,
					Description: "Ключевые слова",
					Required:    true,
				},
			},
		},

		{
			Name:        "delete",
			Description: "Удалить анкету пользователя",
			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UserTag,
					Description: "Никнейм",
					Required:    true,
				},
			},
		},

		{
			Name:        "stats",
			Description: "Статистика",
		},

		{
			Name:        "help",
			Description: "Показать справку из психдиспансера",
		},
	}
}

func (r *resource) Help(_ context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	msg := `**Thief** - честный хранитель анкет

**/get** - получить анкету участника
**/search** - поиск анкет по ключевым словам
**/set** - добавить или изменить анкету
**/delete** - удалить анкету
**/stats** - статистика
**/help** - показать это сообщение

*создание\\изменение возможно только для своего профиля. модераторы могут удалять\\изменять анкеты других пользователей*
*после удалении анкеты юзер теряет роль участника, также после того как юзер выходит — анкета удаляется*

**` + BuildVersion() + `**`

	return r.send(msg)
}

func (r *resource) Get(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseUserID(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	user, err := r.service.GetUser(ctx, parsed)
	if err != nil {
		r.log.Error(err)
		return r.send(ErrFormNotFound.Error())
	}

	return r.sendSilent(makePrettyStructure(user))
}

func (r *resource) Search(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseKeyword(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	users, err := r.service.SearchByKeyword(ctx, parsed)
	if err != nil {
		return r.send(ErrNotFound.Error())
	}

	return r.sendSilent(maxLengthCorrector(makePrettyUserSlice, users))
}

func maxLengthCorrector(prettier func(data []User) string, users []User) string {
	text := prettier(users)
	if len(text) > 2000 {
		text = maxLengthCorrector(prettier, users[:len(users)-1])
	}

	return text
}

func ParseKeyword(options discord.CommandInteractionOptions) (string, error) {
	var (
		keyword        string
		errAccumulator error
	)

	if err := validator.ValidateDiscord(keywordField, options, &keyword); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if errAccumulator != nil {
		errAccumulator.(*multierror.Error).ErrorFormat = errorFormatter
	}

	return keyword, errAccumulator
}

func ParseUserID(data discord.CommandInteractionOptions) (UserID, error) {
	value, err := data.Find(UserTag).SnowflakeValue()
	return UserID(value), err
}

func (r *resource) Set(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseUser(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	if !checkAccess(r.supportRoleID, data.Event.Member, parsed.ID) {
		return r.send(ErrNoAccess.Error())
	}

	parsed.AddedBy = UserID(data.Event.Member.User.ID)
	parsed.CreatedAt = time.Now()

	if err := r.service.CreateUser(ctx, parsed); err != nil {
		r.log.Error(err)
		return r.send("Не удалось создать анкету для пользователя: " + err.Error())
	}

	for _, id := range r.memberRoleID {
		if err := r.service.AddRole(data.Event.GuildID, parsed.ID, RoleID(id)); err != nil {
			r.log.Error(err)
			return r.send("Не удалось добавить роль для пользователя: " + err.Error())
		}
	}

	return r.send("Анкета добавлена")
}

// checkAccess
// Проверяет, есть ли у пользователя доступ к команде
// Проверяет, есть ли у пользователя роль supportRoleID
func checkAccess(supportRoleID []SupportRoleID, member *discord.Member, selectable UserID) bool {
	// Если пользователь отправивший команду - это сам пользователь
	if UserID(member.User.ID) == selectable {
		return true
	}

	for _, role := range member.RoleIDs {
		for _, support := range supportRoleID {
			if uint64(role) == uint64(support) {
				return true
			}
		}
	}

	return false
}

func (r *resource) Delete(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseUserID(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	if !checkAccess(r.supportRoleID, data.Event.Member, parsed) {
		return r.send(ErrNoAccess.Error())
	}

	if err := r.service.DeleteUser(ctx, parsed); err != nil {
		err = errors.Wrap(err, "failed to delete user")
		r.log.Error(err)
	}

	return r.send("Анкета удалена")
}

//func (r *resource) CheckAccess(next cmdroute.InteractionHandler) cmdroute.InteractionHandler {
//	return cmdroute.InteractionHandlerFunc(
//		func(ctx context.Context, ev *discord.InteractionEvent) *api.InteractionResponse {
//			if ev.Data.InteractionType() == discord.CommandInteractionType {
//				interaction := ev.Data.(*discord.CommandInteraction)
//
//				userID, err := ParseUserID(interaction.Options)
//				if err != nil {
//					return r.createInteractionErrorResponse(err)
//				}
//
//				if !checkAccess(r.supportRoleID, ev.Member, userID) {
//					return r.createInteractionErrorResponse(ErrNoAccess)
//				}
//			}
//
//			return next.HandleInteraction(ctx, ev)
//		})
//}

//func (r *resource) createInteractionErrorResponse(err error) *api.InteractionResponse {
//	return &api.InteractionResponse{
//		Type: api.MessageInteractionWithSource,
//		Data: r.send(err.Error()),
//	}
//}

func (r *resource) Stats(ctx context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	stats, err := r.service.PrettyStats(ctx)
	if err != nil {
		err = errors.Wrap(err, "failed to get stats")
		r.log.Error(err)

		return r.send("Не удалось получить статистику: " + err.Error())
	}

	return r.sendSilent(makePrettyStructure(stats))
}

func (r *resource) send(msg string) *api.InteractionResponseData {
	return &api.InteractionResponseData{Content: option.NewNullableString(msg)}
}

func (r *resource) sendSilent(msg string) *api.InteractionResponseData {
	return &api.InteractionResponseData{
		Content: option.NewNullableString(msg),
		AllowedMentions: &api.AllowedMentions{
			Parse: []api.AllowedMentionType{},
		},
	}
}

// makePrettyStructure
// pretty marshal
func makePrettyStructure(data interface{}) string {
	v := reflect.ValueOf(data)
	t := v.Type()

	var sb strings.Builder
	sb.Grow(512)

	for i := 0; i < v.NumField(); i++ {
		field, name := v.Field(i), t.Field(i).Name
		value := fmt.Sprint(field.Interface())

		switch discordTag := t.Field(i).Tag.Get("discord"); discordTag {
		case "id":
			value = fmt.Sprintf("<@%v>", field.Interface())
		}

		sb.WriteString("**")
		if prettyTag := t.Field(i).Tag.Get("pretty"); prettyTag != "" {
			sb.WriteString(prettyTag)
		} else {
			sb.WriteString(name)
		}

		sb.WriteString("**: ")
		sb.WriteString(value)
		sb.WriteString("\n")

	}

	return sb.String()
}

// makePrettyUserSlice
// pretty marshal
func makePrettyUserSlice(data []User) string {
	var sb strings.Builder
	sb.Grow(2560)

	for _, structure := range data {
		sb.WriteString(makePrettyStructure(structure))
		sb.WriteString("\n")
	}

	return sb.String()
}

func ParseUser(opt discord.CommandInteractionOptions) (User, error) {
	var (
		user           = User{}
		errAccumulator error
	)

	id, parseIDErr := ParseUserID(opt)
	if parseIDErr != nil {
		errAccumulator = multierror.Append(errAccumulator, parseIDErr)
	}

	user.ID = id

	age, err := opt.Find(AgeTag).IntValue()
	if age < 12 || age > 70 || err != nil {
		errAccumulator = multierror.Append(errAccumulator, ErrInvalidAge)
	}

	user.Age = int(age)

	if err := validator.ValidateDiscord(nameField, opt, &user.Name); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(locationField, opt, &user.Location); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(hobbiesField, opt, &user.Hobbies); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(occupationField, opt, &user.Occupation); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(goalsField, opt, &user.Goals); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if errAccumulator != nil {
		errAccumulator.(*multierror.Error).ErrorFormat = errorFormatter
	}

	return user, errAccumulator
}

func errorFormatter(es []error) string {
	if len(es) == 1 {
		return fmt.Sprintf("Обнаружена ошибка:\n\t* %s\n\n", es[0])
	}

	points := make([]string, len(es))
	for i, err := range es {
		points[i] = fmt.Sprintf("* %s", err)
	}

	return fmt.Sprintf(
		"%d ошибок обнаружено:\n\t%s\n\n",
		len(es), strings.Join(points, "\n\t"))
}
