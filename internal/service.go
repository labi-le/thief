package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
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
	repo UserRepository
	bot  *state.State
}

func (s *service) AddRole(guildID discord.GuildID, userID UserID, roleID RoleID) error {
	return s.bot.AddRole(
		guildID,
		discord.UserID(userID),
		discord.RoleID(roleID),
		api.AddRoleData{AuditLogReason: "User added to thief db"},
	)
}

func NewUserService(repo UserRepository, bot *state.State) UserService {
	return &service{repo: repo, bot: bot}
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
	u, _ := s.repo.GetUser(ctx, user.ID)
	if u.ID == 0 {
		return s.CreateUser(ctx, user)
	}
	return s.repo.UpdateUser(ctx, user)
}

func (s *service) DeleteUser(ctx context.Context, id UserID) error {
	return s.repo.DeleteUser(ctx, id)
}

func (s *service) PrettyStats(ctx context.Context) (PrettyStats, error) {
	return s.repo.PrettyStats(ctx)
}
