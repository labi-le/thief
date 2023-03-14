package validator

func IsUint64(raw any) bool {
	_, ok := raw.(uint64)
	return ok
}
