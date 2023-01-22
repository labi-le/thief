package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/sirupsen/logrus"
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
	log *logrus.Logger,
) StateService {
	return &stateService{
		Timeout:        timeout,
		GuildID:        guildID,
		userRepository: ur,
		bot:            state,
		log:            log,
	}
}

type stateService struct {
	Timeout time.Duration

	userRepository UserRepository
	bot            *state.State
	GuildID        GuildID
	log            *logrus.Logger
}

func (s *stateService) RunJob(ctx context.Context) error {
	if s.Timeout <= 0 {
		s.log.Warn("timeout is not set, job will not run")
		return nil
	}

	for range time.After(s.Timeout) {
		select {
		case <-ctx.Done():
			return nil
		default:
			s.log.Info("start job")

			s.log.Info("get users from db")
			users, err := s.userRepository.All(ctx)
			if err != nil {
				s.log.Error(err)
				return err
			}

			s.log.Info("get members from discord")
			members, apiErr := s.bot.Members(discord.GuildID(s.GuildID))
			if apiErr != nil {
				s.log.Error(apiErr)

				return err
			}

			diff := diffUsers(users, members)
			if len(diff) == 0 {
				s.log.Info("no users to delete")
				return nil
			}

			s.log.Infof("delete users: %v", diff)
			if err := s.userRepository.DeleteUsers(ctx, diff...); err != nil {
				s.log.Error(err)
				return err
			}

			s.log.Info("job done, sleeping...")
		}
	}

	return nil
}

func diffUsers(users []User, members []discord.Member) []uint64 {
	var diff []uint64

	for _, u := range users {
		var found bool
		for _, m := range members {
			if u.ID == uint64(m.User.ID) {
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
