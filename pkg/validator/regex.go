package validator

import "regexp"

func RegexValidate(regex string) Validatable {
	return func(raw any) bool {
		s, ok := raw.(string)
		if !ok {
			panic(ErrInvalidType)
		}

		return regexp.MustCompile(regex).MatchString(s)
	}
}
