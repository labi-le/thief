package formatter

import (
	"fmt"
	"reflect"
	"strings"
)

// PrettyStructure
// pretty marshal
func PrettyStructure(data any) string {
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
