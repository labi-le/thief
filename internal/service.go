package internal

import (
	"context"
	"github.com/diamondburned/arikawa/v3/api"
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/diamondburned/arikawa/v3/state"
	"math"
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
	var pretty PrettyStats

	all, err := s.repo.All(ctx)
	if err != nil {
		return PrettyStats{}, err
	}

	var (
		averageAge       int
		popularCity      string
		popularName      string
		popularSupporter UserID
	)

	var (
		counterCity    = make(map[string]int)
		counterName    = make(map[string]int)
		supportCounter = make(map[UserID]int)
		allAges        int
		usersLength    = len(all)
	)

	for _, user := range all {
		// средний возраст
		allAges += user.Age
		// самый популярный город
		counterCity[user.Location]++
		// самое популярное имя
		counterName[user.Name]++
		// самый популярный добавивший
		supportCounter[user.AddedBy]++
	}

	averageAge = int(math.Round(float64(allAges) / float64(usersLength)))

	for city, count := range counterCity {
		if count > counterCity[popularCity] {
			popularCity = city
		}
	}

	for name, count := range counterName {
		if count > counterName[popularName] {
			popularName = name
		}
	}

	for id, count := range supportCounter {
		if count > supportCounter[popularSupporter] {
			popularSupporter = id
		}
	}

	pretty.TotalUsers = uint64(len(all))
	// сортировка идёт по desc значит берём первый элемент
	pretty.LastUser = all[0].ID
	pretty.AverageAge = averageAge
	pretty.PopularCity = popularCity
	pretty.PopularName = popularName
	pretty.PopularSupporter = popularSupporter

	return pretty, nil
}
