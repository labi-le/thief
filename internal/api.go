package internal

import (
	"context"
	"dario.cat/mergo"
	"encoding/json"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/api/cmdroute"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/pkg/errors"
	"github.com/rs/zerolog/log"
	"thief/pkg/formatter"
	"time"
)

type resource struct {
	*cmdroute.Router
	bot *state.State

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

func RegisterHandlers(bot *state.State, service UserService, conf Config) {
	me, err := bot.Me()
	if err != nil {
		panic(errors.Wrap(err, "failed to get self id"))
	}

	log.Info().Msgf("%s is running", me.Username)

	res := &resource{
		bot:           bot,
		Router:        cmdroute.NewRouter(),
		self:          me,
		service:       service,
		supportRoleID: conf.SupportRoleID,
		memberRoleID:  conf.MemberRoleID,
	}

	bot.AddInteractionHandler(res)

	res.AddFunc("stats", res.LoggerMiddleware(res.Stats))
	res.AddFunc("help", res.LoggerMiddleware(res.Help))
	res.AddFunc("get", res.LoggerMiddleware(res.Get))
	res.AddFunc("search", res.LoggerMiddleware(res.Search))

	res.AddFunc("set", res.LoggerMiddleware(res.CheckAccessMiddleware(res.Set)))
	res.AddFunc("edit", res.LoggerMiddleware(res.CheckAccessMiddleware(res.Edit)))
	res.AddFunc("delete", res.LoggerMiddleware(res.CheckAccessMiddleware(res.Delete)))

	if err := cmdroute.OverwriteCommands(bot, getInlineCommands()); err != nil {
		panic(errors.Wrap(err, "failed to overwrite commands"))
	}
}

func (r *resource) Help(_ context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	msg := `**Thief** - честный хранитель анкет

` + PrettySlashCommands("get", r.self.ID) + ` - получить анкету участника
` + PrettySlashCommands("search", r.self.ID) + ` - поиск анкет по ключевым словам
` + PrettySlashCommands("set", r.self.ID) + ` - добавить или изменить анкету
` + PrettySlashCommands("delete", r.self.ID) + ` - удалить анкету
` + PrettySlashCommands("stats", r.self.ID) + ` - статистика
` + PrettySlashCommands("help", r.self.ID) + ` - показать это сообщение

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
		log.Err(err).Msg("failed to get user")
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

func (r *resource) Set(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := ParseUser(data.Options)
	if parsErr != nil {
		return r.send(parsErr.Error())
	}

	parsed.AddedBy = UserID(data.Event.Member.User.ID)
	parsed.CreatedAt = time.Now()

	if err := r.service.CreateUser(ctx, parsed); err != nil {
		log.Err(err).Msg("failed to create user")
		return r.send("Не удалось создать анкету для пользователя: " + err.Error())
	}

	if err := r.service.AddRole(data.Event.GuildID, parsed.ID, r.memberRoleID...); err != nil {
		return r.send("Не удалось добавить роль пользователю: " + err.Error())
	}

	return r.send("Анкета добавлена")
}

func (r *resource) Edit(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, _ := ParseUser(data.Options)
	//if parsErr != nil {
	//	return r.send(parsErr.Error())
	//}

	user, err := r.service.GetUser(ctx, parsed.ID)
	if err != nil {
		log.Err(err).Msg("failed to get user")
		return r.send(ErrFormNotFound.Error())
	}

	updated := CompareUser(user, parsed)

	if err := r.service.UpdateUser(ctx, updated); err != nil {
		log.Err(err).Msg("failed to update user")
		return r.send("Не удалось создать анкету для пользователя: " + err.Error())
	}

	return r.send("Анкета добавлена")
}

// CompareUser сравнивает две анкеты и возвращает обновленную анкету
func CompareUser(dst User, src User) User {
	if err := mergo.Merge(&dst, src, mergo.WithOverride); err != nil {
		return User{}
	}
	return dst
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
			log.Err(err).Msg("failed to remove role")
		}
	}(r.service, data.Event.GuildID, parsed, r.memberRoleID...)

	if err := r.service.DeleteUser(ctx, parsed); err != nil {
		log.Err(err).Msg("failed to delete user")

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
		log.Err(err).Msg("failed to get stats")

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

func (r *resource) LoggerMiddleware(fn cmdroute.CommandHandlerFunc) cmdroute.CommandHandlerFunc {
	return func(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
		marshal, _ := json.Marshal(data)
		log.Info().Msg(string(marshal))

		return fn(ctx, data)
	}
}
