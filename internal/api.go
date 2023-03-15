package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/api/cmdroute"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/pkg/errors"
	"github.com/sirupsen/logrus"
	"thief/pkg/formatter"
	"time"
)

type resource struct {
	*cmdroute.Router
	bot *state.State
	log *logrus.Logger

	self    *discord.User
	service UserService

	supportRoleID []RoleID
	memberRoleID  []RoleID
}

const (
	UsernameTag   = "username"
	AgeTag        = "age"
	NameTag       = "name"
	LocationTag   = "location"
	HobbiesTag    = "hobbies"
	OccupationTag = "occupation"
	GoalsTag      = "goals"

	KeywordTag       = "keyword"
	KeywordOffsetTag = "offset"
	KeywordLimitTag  = "limit"
)

var (
	ErrNoAccess     = errors.New("У вас нет доступа к этой команде")
	ErrFormNotFound = errors.New("Анкета не найдена")
	ErrNotFound     = errors.New("По вашему запросу ничего не найдено")
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

	res.AddFunc("set", res.CheckAccessMiddleware(res.Set))
	res.AddFunc("delete", res.CheckAccessMiddleware(res.Delete))

	if err := cmdroute.OverwriteCommands(bot, getInlineCommands()); err != nil {
		panic(errors.Wrap(err, "failed to overwrite commands"))
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

	return r.sendSilent(formatter.PrettyStructure(user))
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

	Offset(parsed.Limit, parsed.Offset, &users)

	return r.sendSilent(PrettySlice(users))
}

func maxLengthCorrector(prettier func(data []User) string, users []User) string {
	text := prettier(users)
	if len(text) > 2000 {
		text = maxLengthCorrector(prettier, users[:len(users)-1])
	}

	return text
}

func (r *resource) Set(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseUser(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	parsed.AddedBy = UserID(data.Event.Member.User.ID)
	parsed.CreatedAt = time.Now()

	if err := r.service.CreateUser(ctx, parsed); err != nil {
		r.log.Error(err)
		return r.send("Не удалось создать анкету для пользователя: " + err.Error())
	}

	if err := r.service.AddRole(data.Event.GuildID, parsed.ID, r.memberRoleID...); err != nil {
		return r.send("Не удалось добавить роль пользователю: " + err.Error())
	}

	return r.send("Анкета добавлена")
}

// checkAccess
// Проверяет, есть ли у пользователя доступ к команде
// Проверяет, есть ли у пользователя роль supportRoleID
func checkAccess(supportRoleID []RoleID, member *discord.Member, selectable UserID) bool {
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

	defer func(service UserService, guildID discord.GuildID, id UserID, roleID ...RoleID) {
		err := service.RemoveRole(guildID, id, roleID...)
		if err != nil {
			r.log.Error(errors.Wrap(err, "failed to remove role"))
		}
	}(r.service, data.Event.GuildID, parsed, r.memberRoleID...)

	if err := r.service.DeleteUser(ctx, parsed); err != nil {
		r.log.Error(errors.Wrap(err, "failed to delete user"))
	}

	return r.send("Анкета удалена")
}

func (r *resource) createInteractionErrorResponse(err error) *api.InteractionResponse {
	return &api.InteractionResponse{
		Type: api.MessageInteractionWithSource,
		Data: r.send(err.Error()),
	}
}

func (r *resource) Stats(ctx context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	stats, err := r.service.PrettyStats(ctx)
	if err != nil {
		err = errors.Wrap(err, "failed to get stats")
		r.log.Error(err)

		return r.send("Не удалось получить статистику: " + err.Error())
	}

	return r.sendSilent(formatter.PrettyStructure(stats))
}

func (r *resource) CheckAccessMiddleware(fn cmdroute.CommandHandlerFunc) cmdroute.CommandHandlerFunc {
	return func(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
		interaction := data.Event.Data.(*discord.CommandInteraction)

		userID, err := ParseUserID(interaction.Options)
		if err != nil {
			return r.send(err.Error())
		}

		if !checkAccess(r.supportRoleID, data.Event.Member, userID) {
			return r.send(ErrNoAccess.Error())
		}

		return fn(ctx, data)
	}
}
