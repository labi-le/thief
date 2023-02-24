package internal

import (
	"context"
	"encoding/json"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/api/cmdroute"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/diamondburned/arikawa/v3/utils/json/option"
	"github.com/pkg/errors"
	"github.com/sirupsen/logrus"
	"regexp"
	"strings"
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
)

var (
	ErrInvalidAge = errors.New("Столько люди не живут!")

	ErrNoAccess     = errors.New("У вас нет доступа к этой команде")
	ErrFormNotFound = errors.New("Анкета не найдена")

	ErrValidateForm = errors.New("Форма не соответствует регулярному выражению")
)

type (
	SupportRoleID uint64
	MemberRoleID  uint64
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
	res.Use(res.CheckAccess)
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
	msg := `**Thief** - честный аккумулятор анкет

**/get** - получить анкету участника
**/set** - добавить или изменить анкету
**/delete** - удалить анкету
**/help** - показать это сообщение`

	return r.send(msg)
}

func (r *resource) Get(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	user, err := r.service.GetUser(ctx, parsed.ID)
	if err != nil {
		r.log.Error(err)
		return r.send(ErrFormNotFound.Error())
	}

	return r.send(makeJsonInteractionData(user))
}

func (r *resource) Set(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return &api.InteractionResponseData{
			Content: option.NewNullableString(parsErr.Error()),
		}
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
func checkAccess(supportRoleID []SupportRoleID, member *discord.Member, selectable User) bool {
	// Если пользователь отправивший команду - это сам пользователь
	if UserID(member.User.ID) == selectable.ID {
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
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	if err := r.service.DeleteUser(ctx, parsed.ID); err != nil {
		err = errors.Wrap(err, "failed to delete user")
		r.log.Error(err)
	}

	return r.send("Анкета удалена")
}

func (r *resource) Stats(ctx context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	stats, err := r.service.PrettyStats(ctx)
	if err != nil {
		err = errors.Wrap(err, "failed to get stats")
		r.log.Error(err)

		return r.send("Не удалось получить статистику: " + err.Error())
	}

	return r.send(makeJsonInteractionData(stats))
}

func (r *resource) CheckAccess(next cmdroute.InteractionHandler) cmdroute.InteractionHandler {
	return cmdroute.InteractionHandlerFunc(
		func(ctx context.Context, ev *discord.InteractionEvent) *api.InteractionResponse {
			if ev.Data.InteractionType() == discord.CommandInteractionType {
				interaction := ev.Data.(*discord.CommandInteraction)

				parsed, err := parseUser(interaction.Options)
				if err != nil {
					return r.createInteractionErrorResponse(err)
				}

				if !checkAccess(r.supportRoleID, ev.Member, parsed) {
					return r.createInteractionErrorResponse(ErrNoAccess)
				}
			}

			return next.HandleInteraction(ctx, ev)
		})
}

func (r *resource) createInteractionErrorResponse(err error) *api.InteractionResponse {
	return &api.InteractionResponse{
		Type: api.MessageInteractionWithSource,
		Data: r.send(err.Error()),
	}
}

func (r *resource) send(msg string) *api.InteractionResponseData {
	return &api.InteractionResponseData{Content: option.NewNullableString(msg)}
}

// makeJsonInteractionData
// pretty marshal
func makeJsonInteractionData(data any) string {
	b, err := json.MarshalIndent(data, "", "  ")
	if err != nil {
		panic(err)
	}
	return "```json\n " + string(b) + "```"
}

var (

	// regexpName валидация имени пользователя (только буквы)
	regexpName = regexp.MustCompile(`^[a-zA-Zа-яА-Я-]{1,50}$`)
	// regexpLocation валидация местоположения пользователя (только буквы, тире, пробелы)
	regexpLocation = regexp.MustCompile(`^[a-zA-Zа-яА-Я]+(?:[ -][a-zA-Zа-яА-Я]+)*$`)
	// regexpHobbies валидация хобби пользователя (например "рисование, игра на гитаре, видеоигры, anime")
	regexpText = regexp.MustCompile(`^[a-zA-Zа-яА-Я\s,]+$`)
)

func parseUser(opt discord.CommandInteractionOptions) (User, error) {
	user := User{}

	value, _ := opt.Find(UserTag).SnowflakeValue()
	user.ID = UserID(value)

	age, _ := opt.Find(AgeTag).IntValue()
	if age < 12 || age > 70 {
		return user, ErrInvalidAge
	}

	user.Age = int(age)

	name := strings.TrimSpace(opt.Find(NameTag).String())
	if !regexpName.MatchString(name) {
		return user, errors.Wrap(ErrValidateForm, NameTag)
	}

	user.Name = name

	location := strings.TrimSpace(opt.Find(LocationTag).String())
	if !regexpLocation.MatchString(location) {
		return user, errors.Wrap(ErrValidateForm, LocationTag)
	}

	user.Location = location

	hobbies := strings.TrimSpace(opt.Find(HobbiesTag).String())
	if !regexpText.MatchString(hobbies) {
		return user, errors.Wrap(ErrValidateForm, HobbiesTag)
	}

	user.Hobbies = hobbies

	occupation := strings.TrimSpace(opt.Find(OccupationTag).String())
	if !regexpText.MatchString(occupation) {
		return user, errors.Wrap(ErrValidateForm, OccupationTag)
	}

	user.Occupation = occupation

	goals := strings.TrimSpace(opt.Find(GoalsTag).String())
	if !regexpText.MatchString(goals) {
		return user, errors.Wrap(ErrValidateForm, GoalsTag)
	}

	user.Goals = goals

	return user, nil
}
