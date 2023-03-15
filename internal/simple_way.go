package internal

import (
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/utils/json/option"
)

func (r *resource) send(msg string) *api.InteractionResponseData {
	return &api.InteractionResponseData{Content: option.NewNullableString(msg)}
}

func (r *resource) sendSilent(msg string) *api.InteractionResponseData {
	return &api.InteractionResponseData{
		Content: option.NewNullableString(msg),
		AllowedMentions: &api.AllowedMentions{
			Parse: []api.AllowedMentionType{},
		},
	}
}

func Offset(limit, offset int, users *[]User) {
	if limit <= 0 {
		limit = 5
	}

	if offset < 0 {
		offset = 0
	}

	// Offset correction if greater than total
	if offset > len(*users) {
		offset = len(*users) - 5
	}

	if offset+limit > len(*users) {
		limit = len(*users) - offset
	}

	*users = (*users)[offset : offset+limit]
}
