package validator

import (
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/pkg/errors"
	"log"
	"reflect"
)

var (
	ErrValidateForm = errors.New("Некорректное значение для поля %s. Пример: %s")
	ErrInvalidType  = errors.New("Некорректный тип")
)

type Validatable func(raw any) bool

type Field struct {
	Name    string
	Tag     string
	IsValid Validatable
	Example any
}

type RawField any

func Validate(f Field, r RawField, v any) error {
	vPtr := reflect.ValueOf(v)
	if vPtr.Kind() != reflect.Ptr || vPtr.IsNil() {
		panic("v is not a valid pointer")
	}

	if !f.IsValid(r) {
		return errors.Errorf(
			ErrValidateForm.Error(),
			f.Tag,
			f.Example,
		)
	}

	vPtr.Elem().Set(reflect.ValueOf(r).Convert(vPtr.Type().Elem()))

	return nil
}

func ValidateDiscord(f Field, rawField discord.CommandInteractionOptions, v any) error {
	var (
		rf  RawField
		err error
	)

	find := rawField.Find(f.Tag)

	switch reflect.ValueOf(v).Elem().Kind().String() {
	case "string":
		rf = find.String()
	case "int":
		rf, err = find.IntValue()
		rf = int(rf.(int64))
	case "int8":
		rf, err = find.IntValue()
		rf = int8(rf.(int64))
	case "int16":
		rf, err = find.IntValue()
		rf = int16(rf.(int64))
	case "int32":
		rf, err = find.IntValue()
		rf = int32(rf.(int64))
	case "int64":
		rf, err = find.IntValue()
	case "float64":
		rf, err = find.FloatValue()
	case "uint64":
		rf, err = find.SnowflakeValue()
		rf = uint64(rf.(discord.Snowflake))
	case "bool":
		rf, err = find.BoolValue()
	default:
		log.Panicf("unknown type %T", v)
	}

	if err != nil {
		return err
	}

	return Validate(f, rf, v)
}
