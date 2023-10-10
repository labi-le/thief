package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/rs/zerolog/log"
	"time"
)

type StateService interface {
	RunJob(ctx context.Context) error
}

type GuildID discord.GuildID

func NewStateService(
	timeout time.Duration,
	guildID GuildID,
	ur UserRepository,
	state *state.State,
) StateService {
	return &stateService{
		Timeout:        timeout,
		GuildID:        guildID,
		userRepository: ur,
		bot:            state,
	}
}

type stateService struct {
	Timeout time.Duration

	userRepository UserRepository
	bot            *state.State
	GuildID        GuildID
}

func (s *stateService) RunJob(ctx context.Context) error {
	if s.Timeout <= 0 {
		log.Warn().Msg("timeout is not set, job will not run")
		return nil
	}

	for range time.After(s.Timeout) {
		select {
		case <-ctx.Done():
			return nil
		default:
			log.Info().Msg("start job")

			log.Trace().Msg("get users from db")
			users, err := s.userRepository.All(ctx)
			if err != nil {
				log.Err(err).Msg("failed to get users")
				return err
			}

			log.Trace().Msg("get members")
			members, apiErr := s.bot.Members(discord.GuildID(s.GuildID))
			if apiErr != nil {
				log.Err(apiErr).Msg("failed to get members")
				return err
			}

			diff := diffUsers(users, members)
			if len(diff) == 0 {
				log.Warn().Msg("no users to delete")
				return nil
			}

			log.Trace().Msg("delete users")
			if err := s.userRepository.DeleteUsers(ctx, diff...); err != nil {
				log.Err(err).Msg("failed to delete users")
				return err
			}

			log.Info().Msg("job done, sleeping...")
		}
	}

	return nil
}

func diffUsers(users []User, members []discord.Member) []UserID {
	var diff []UserID

	for _, u := range users {
		var found bool
		for _, m := range members {
			if u.ID == UserID(m.User.ID) {
				found = true
				break
			}
		}

		if !found {
			diff = append(diff, u.ID)
		}
	}

	return diff
}
