package internal

import "thief/pkg/validator"

var (
	nicknameField = validator.Field{
		Name:    "Никнейм",
		Tag:     UsernameTag,
		IsValid: validator.IsUint64,
		Example: "<@465805471786336256>",
	}

	nameField = validator.Field{
		Name:    "Имя",
		Tag:     NameTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ-]{1,50}$`),
		Example: "Анастасия",
	}

	ageField = validator.Field{
		Name:    "Возраст",
		Tag:     AgeTag,
		IsValid: validator.RangeInt(12, 70),
		Example: "От 12 до 70",
	}

	locationField = validator.Field{
		Name:    "Город проживания",
		Tag:     LocationTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ]+(?:[ -][a-zA-Zа-яА-ЯёЁ]+)*$`),
		Example: "Екатеринбург",
	}

	hobbiesField = validator.Field{
		Name:    "Хобби",
		Tag:     HobbiesTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "рисование, игра на гитаре, видеоигры, anime",
	}

	occupationField = validator.Field{
		Name:    "Род деятельности (учеба, работа)",
		Tag:     OccupationTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "работаю",
	}

	goalsField = validator.Field{
		Name:    "Цели",
		Tag:     GoalsTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "познакомиться с новыми людьми",
	}

	keywordField = validator.Field{
		Name:    "Ключевые слова",
		Tag:     KeywordTag,
		IsValid: validator.RegexValidate(`^[a-zA-Zа-яА-ЯёЁ\s,-]+$`),
		Example: "общение",
	}
)
