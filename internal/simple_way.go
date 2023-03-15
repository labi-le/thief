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
