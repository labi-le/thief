package validator

func RangeInt(min, max int) Validatable {
	return func(raw any) bool {
		i, ok := raw.(int)
		if !ok {
			panic(ErrInvalidType)
		}

		return i >= min && i <= max
	}
}

func RangeInt64(min, max int64) Validatable {
	return func(raw any) bool {
		i, ok := raw.(int64)
		if !ok {
			panic(ErrInvalidType)
		}

		return i >= min && i <= max
	}
}

func RangeFloat64(min, max float64) Validatable {
	return func(raw any) bool {
		i, ok := raw.(float64)
		if !ok {
			panic(ErrInvalidType)
		}

		return i >= min && i <= max
	}
}

func RangeUint64(min, max uint64) Validatable {
	return func(raw any) bool {
		i, ok := raw.(uint64)
		if !ok {
			panic(ErrInvalidType)
		}

		return i >= min && i <= max
	}
}
