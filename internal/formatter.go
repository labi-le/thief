package internal

import (
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
