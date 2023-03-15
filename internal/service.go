package internal

import (
	"context"
	"crypto/md5"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/hashicorp/go-multierror"
	"github.com/patrickmn/go-cache"
	"time"
)

type UserService interface {
	CreateUser(ctx context.Context, user User) error
	GetUser(ctx context.Context, id UserID) (User, error)
	UpdateUser(ctx context.Context, user User) error
	DeleteUser(ctx context.Context, id UserID) error

	PrettyStats(ctx context.Context) (PrettyStats, error)

	AddRole(guildID discord.GuildID, id UserID, roleID ...RoleID) error
	RemoveRole(guildID discord.GuildID, id UserID, roleID ...RoleID) error

	SearchByKeyword(ctx context.Context, search Keyword) ([]User, error)
}

type service struct {
	repo  UserRepository
	bot   *state.State
	cache *cache.Cache
}

func (s *service) RemoveRole(guildID discord.GuildID, userID UserID, roleID ...RoleID) error {
	var err error
	for _, id := range roleID {
		apiErr := s.bot.RemoveRole(
			guildID,
			discord.UserID(userID),
			discord.RoleID(id),
			"User removed role by thief",
		)
		if apiErr != nil {
			err = multierror.Append(err, apiErr)
		}
	}

	return err
}

func NewUserService(repo UserRepository, bot *state.State, cache *cache.Cache) UserService {
	return &service{repo: repo, bot: bot, cache: cache}
}

func (s *service) AddRole(guildID discord.GuildID, userID UserID, roleID ...RoleID) error {
	var err error
	for _, id := range roleID {
		apiErr := s.bot.AddRole(
			guildID,
			discord.UserID(userID),
			discord.RoleID(id),
			api.AddRoleData{AuditLogReason: "User added to thief db"},
		)
		if apiErr != nil {
			err = multierror.Append(err, apiErr)
		}
	}

	return err
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
	StatsCache           = "stats"
	SearchByKeywordCache = "search-by-keyword-"
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

func (s *service) SearchByKeyword(ctx context.Context, kw Keyword) ([]User, error) {
	hash := md5.New().Sum([]byte(kw.Search))
	cacheKey := SearchByKeywordCache + string(hash)

	var users []User
	v, err := s.cacheGetOrSet(cacheKey, func() (any, error) {
		return s.repo.SearchForAllColumns(ctx, kw.Search)
	}, FiveMinute)

	if err != nil {
		return users, err
	}

	return v.([]User), nil
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
