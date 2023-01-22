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
	"strings"
	"time"
)

type resource struct {
	*cmdroute.Router
	bot *state.State
	log *logrus.Logger

	self    *discord.User
	service UserService
}

var (
	ErrInvalidName = errors.New(
		"рофлан! не ври! я знаю только одно человека с длинным именем — **Uwuwewewe Onyetenwewe Ugweuhem Osas**")
	ErrInvalidAge = errors.New("рофлан! не обманывай! не может быть тебе столько лет!")
	ErrBigLength  = errors.New("рофлан! слишком много текста, а ну-ка давай сократи")
)

func RegisterHandlers(bot *state.State, logger *logrus.Logger, service UserService) {
	me, err := bot.Me()
	if err != nil {
		panic(errors.Wrap(err, "failed to get self id"))
	}

	logger.Infof("%s is running", me.Username)

	res := &resource{
		bot:     bot,
		Router:  cmdroute.NewRouter(),
		log:     logger,
		self:    me,
		service: service,
	}

	bot.AddInteractionHandler(res)

	//app, _ := bot.CurrentApplication()
	//bot.BulkOverwriteGuildCommands(app.ID, 1060870426617708634, cmds)

	res.AddFunc("set", res.Set)
	res.AddFunc("get", res.Get)
	res.AddFunc("delete", res.Delete)
	res.AddFunc("stats", res.Stats)
	res.AddFunc("help", res.Help)

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
					OptionName:  "user",
					Description: "Никнейм",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  "name",
					Description: "Имя",
					Required:    true,
				},

				&discord.IntegerOption{
					OptionName:  "age",
					Description: "Возраст",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  "location",
					Description: "Город проживания",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  "hobbies",
					Description: "Увлечения",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  "occupation",
					Description: "Род деятельности (учеба, работа)",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  "goals",
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
					OptionName:  "user",
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
					OptionName:  "user",
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

	return &api.InteractionResponseData{
		Content: option.NewNullableString(msg),
	}
}

func (r *resource) Get(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return &api.InteractionResponseData{
			Content: option.NewNullableString(parsErr.Error()),
		}
	}

	user, err := r.service.GetUser(ctx, parsed.ID)
	if err != nil {
		r.log.Error(err)
		return &api.InteractionResponseData{Content: option.NewNullableString("Анкета не найдена")}
	}

	return makeJsonInteractionData(user)
}

func (r *resource) Set(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return &api.InteractionResponseData{
			Content: option.NewNullableString(parsErr.Error()),
		}
	}

	parsed.AddedBy = uint64(data.Event.Member.User.ID)
	parsed.CreatedAt = time.Now()

	if err := r.service.CreateUser(ctx, parsed); err != nil {
		r.log.Error(err)
		return &api.InteractionResponseData{
			Content: option.NewNullableString("Не удалось создать анкету для пользователя: " + err.Error()),
		}
	}

	return &api.InteractionResponseData{Content: option.NewNullableString("Анкета добавлена")}
}

func (r *resource) Delete(ctx context.Context, data cmdroute.CommandData) *api.InteractionResponseData {
	parsed, parsErr := parseUser(data.Options)
	if parsErr != nil {
		return &api.InteractionResponseData{
			Content: option.NewNullableString(parsErr.Error()),
		}
	}

	if err := r.service.DeleteUser(ctx, parsed.ID); err != nil {
		err = errors.Wrap(err, "failed to delete user")
		r.log.Error(err)
	}

	return &api.InteractionResponseData{Content: option.NewNullableString("Анкета удалена")}
}

func (r *resource) Stats(ctx context.Context, _ cmdroute.CommandData) *api.InteractionResponseData {
	stats, err := r.service.PrettyStats(ctx)
	if err != nil {
		err = errors.Wrap(err, "failed to get stats")
		r.log.Error(err)
		return &api.InteractionResponseData{
			Content: option.NewNullableString("Не удалось получить статистику: " + err.Error()),
		}
	}

	return makeJsonInteractionData(stats)
}

// makeJsonInteractionData
// pretty marshal
func makeJsonInteractionData(data any) *api.InteractionResponseData {
	b, err := json.MarshalIndent(data, "", "  ")
	if err != nil {
		panic(err)
	}
	return &api.InteractionResponseData{
		Content: option.NewNullableString("```json\n " + string(b) + "```"),
	}
}

func parseUser(opt discord.CommandInteractionOptions) (User, error) {
	user := User{}

	value, _ := opt.Find("user").SnowflakeValue()
	user.ID = uint64(value)

	age, _ := opt.Find("age").IntValue()
	if age < 0 && age > 70 {
		return user, ErrInvalidAge
	}

	user.Age = int(age)

	name := strings.TrimSpace(opt.Find("name").String())
	if len(name) > 50 {
		return user, ErrInvalidName
	}
	user.Name = name

	location := strings.TrimSpace(opt.Find("location").String())
	if len(location) > 100 {
		return user, ErrBigLength
	}
	user.Location = location

	hobbies := strings.TrimSpace(opt.Find("hobbies").String())
	if len(hobbies) > 255 {
		return user, ErrBigLength
	}
	user.Hobbies = hobbies

	occupation := strings.TrimSpace(opt.Find("occupation").String())
	if len(occupation) > 100 {
		return user, ErrBigLength
	}
	user.Occupation = occupation

	goals := strings.TrimSpace(opt.Find("goals").String())
	if len(goals) > 255 {
		return user, ErrBigLength
	}

	user.Goals = goals

	return user, nil
}
