package validator

import (
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/pkg/errors"
	"reflect"
	"regexp"
	"strings"
)

var ErrValidateForm = errors.New("Некорректное значение для поля %s. Ожидаемый формат: %s. Пример: %s")

type Field struct {
	Name    string
	Tag     string
	Regexp  *regexp.Regexp
	Example any
}

func Validate(f Field, rawField string, v any) error {
	vPtr := reflect.ValueOf(v)
	if vPtr.Kind() != reflect.Ptr || vPtr.IsNil() {
		panic("v is not a valid pointer")
	}

	field := strings.TrimSpace(rawField)

	if !f.Regexp.MatchString(field) {
		return errors.Errorf(
			ErrValidateForm.Error(),
			f.Tag,
			f.Regexp.String(),
			f.Example,
		)
	}

	vPtr.Elem().SetString(field)

	return nil
}

func ValidateDiscord(f Field, rawField discord.CommandInteractionOptions, v any) error {
	return Validate(f, rawField.Find(f.Tag).String(), v)
}
