package internal

import (
	"github.com/diamondburned/arikawa/v3/discord"
	"strconv"
	"strings"
	"thief/pkg/formatter"
)

func PrettySlice(data []User) string {
	var sb strings.Builder
	sb.Grow(2560)

	for _, structure := range data {
		sb.WriteString(formatter.PrettyStructure(structure))
		sb.WriteString("\n")
	}

	return sb.String()
}

// PrettySlashCommands </NAME:COMMAND_ID>
func PrettySlashCommands(t string, id discord.UserID) string {
	var sb strings.Builder
	sb.Grow(2560)

	sb.WriteString("<")
	sb.WriteString("/")
	sb.WriteString(t)
	sb.WriteString(":")
	sb.WriteString(strconv.Itoa(int(id)))
	sb.WriteString(">")

	return sb.String()
}
