package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/patrickmn/go-cache"
	"time"
)

type UserService interface {
	CreateUser(ctx context.Context, user User) error
	GetUser(ctx context.Context, id UserID) (User, error)
	UpdateUser(ctx context.Context, user User) error
	DeleteUser(ctx context.Context, id UserID) error

	PrettyStats(ctx context.Context) (PrettyStats, error)

	AddRole(guildID discord.GuildID, id UserID, roleID RoleID) error
}

type service struct {
	repo  UserRepository
	bot   *state.State
	cache *cache.Cache
}

func NewUserService(repo UserRepository, bot *state.State, cache *cache.Cache) UserService {
	return &service{repo: repo, bot: bot, cache: cache}
}

func (s *service) AddRole(guildID discord.GuildID, userID UserID, roleID RoleID) error {
	return s.bot.AddRole(
		guildID,
		discord.UserID(userID),
		discord.RoleID(roleID),
		api.AddRoleData{AuditLogReason: "User added to thief db"},
	)
}

func (s *service) CreateUser(ctx context.Context, user User) error {
	u, _ := s.repo.GetUser(ctx, user.ID)
	if u.ID != 0 {
		return s.UpdateUser(ctx, user)
	}
	return s.repo.CreateUser(ctx, user)
}

func (s *service) GetUser(ctx context.Context, id UserID) (User, error) {
	return s.repo.GetUser(ctx, id)
}

func (s *service) UpdateUser(ctx context.Context, user User) error {
	return s.repo.UpdateUser(ctx, user)
}

func (s *service) DeleteUser(ctx context.Context, id UserID) error {
	return s.repo.DeleteUser(ctx, id)
}

const (
	StatsCache = "stats"
)

const (
	FiveMinute = 5 * time.Minute
)

func (s *service) PrettyStats(ctx context.Context) (PrettyStats, error) {
	var stats PrettyStats
	v, err := s.cacheGetOrSet(StatsCache, func() (any, error) {
		return s.repo.PrettyStats(ctx)
	}, FiveMinute)
	if err != nil {
		return stats, err
	}
	return v.(PrettyStats), nil
}

func (s *service) cacheGetOrSet(k string, fn func() (any, error), d time.Duration) (any, error) {
	get, exist := s.cache.Get(k)
	if exist {
		return get, nil
	}

	v, err := fn()
	if err == nil {
		s.cache.Set(k, v, d)
	}
	return v, err
}
