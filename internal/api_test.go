package internal

import (
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/utils/json"
	"strconv"
	"testing"
)

func TestParseUser(t *testing.T) {
	user := User{
		ID:         465805471786336256,
		Name:       "Денис",
		Age:        22,
		Location:   "хабаровск",
		Hobbies:    "спать",
		Occupation: "работа",
		Goals:      "покушать вкусно",
	}

	idConv := strconv.Itoa(int(user.ID))
	ageConv := strconv.Itoa(user.Age)

	opt := discord.CommandInteractionOptions{
		discord.CommandInteractionOption{
			Type:  discord.UserOptionType,
			Name:  "username",
			Value: json.Raw(idConv),
		},

		discord.CommandInteractionOption{
			Type:  discord.StringOptionType,
			Name:  "name",
			Value: json.Raw(user.Name),
		},

		discord.CommandInteractionOption{
			Type:  discord.IntegerOptionType,
			Name:  "age",
			Value: json.Raw(ageConv),
		},

		discord.CommandInteractionOption{
			Type:  discord.StringOptionType,
			Name:  "location",
			Value: json.Raw(user.Location),
		},

		discord.CommandInteractionOption{
			Type:  discord.StringOptionType,
			Name:  "hobbies",
			Value: json.Raw(user.Hobbies),
		},

		discord.CommandInteractionOption{
			Type:  discord.StringOptionType,
			Name:  "occupation",
			Value: json.Raw(user.Occupation),
		},

		discord.CommandInteractionOption{
			Type:  discord.StringOptionType,
			Name:  "goals",
			Value: json.Raw(user.Goals),
		},
	}

	uu, err := ParseUser(opt)
	if err != nil {
		t.Error(err)
	}

	if uu != user {
		t.Errorf("want %v, got %v", user, uu)
	}
}
