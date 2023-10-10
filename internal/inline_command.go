package internal

import (
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/utils/json/option"
)

func getInlineCommands() []api.CreateCommandData {
	return []api.CreateCommandData{
		{
			Name:        "set",
			Description: "Добавить анкету пользователя",

			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UsernameTag,
					Description: "Никнейм",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  nameField.Tag,
					Description: nameField.Name,
					Required:    true,
				},

				&discord.IntegerOption{
					OptionName:  ageField.Tag,
					Description: ageField.Name,
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  locationField.Tag,
					Description: locationField.Name,
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  hobbiesField.Tag,
					Description: hobbiesField.Name,
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  occupationField.Tag,
					Description: occupationField.Name,
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  goalsField.Tag,
					Description: goalsField.Name,
					Required:    true,
				},
			},
		},

		{
			Name:        "edit",
			Description: "Отредактировать существующую анкету пользователя",

			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UsernameTag,
					Description: "Никнейм",
					Required:    true,
				},

				&discord.StringOption{
					OptionName:  nameField.Tag,
					Description: nameField.Name,
					Required:    false,
				},

				&discord.IntegerOption{
					OptionName:  ageField.Tag,
					Description: ageField.Name,
					Required:    false,
				},

				&discord.StringOption{
					OptionName:  locationField.Tag,
					Description: locationField.Name,
					Required:    false,
				},

				&discord.StringOption{
					OptionName:  hobbiesField.Tag,
					Description: hobbiesField.Name,
					Required:    false,
				},

				&discord.StringOption{
					OptionName:  occupationField.Tag,
					Description: occupationField.Name,
					Required:    false,
				},

				&discord.StringOption{
					OptionName:  goalsField.Tag,
					Description: goalsField.Name,
					Required:    false,
				},
			},
		},

		{
			Name:        "get",
			Description: "Получить анкету пользователя",

			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UsernameTag,
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
					OptionName:  keywordField.Tag,
					Description: keywordField.Name,
					Required:    true,
				},

				&discord.IntegerOption{
					OptionName:  keywordLimitField.Tag,
					Description: keywordLimitField.Name,
					Required:    false,
					Min:         option.NewInt(1),
					Max:         option.NewInt(5),
				},

				&discord.IntegerOption{
					OptionName:  keywordOffsetField.Tag,
					Description: keywordOffsetField.Name,
					Required:    false,
					Min:         option.NewInt(1),
					Max:         option.NewInt(100),
				},
			},
		},

		{
			Name:        "delete",
			Description: "Удалить анкету пользователя",
			Options: []discord.CommandOption{
				&discord.UserOption{
					OptionName:  UsernameTag,
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
