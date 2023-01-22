package internal

import (
	"context"
	"math"
)

type PrettyStats struct {
	TotalUsers       int64  `json:"total_users"`
	LastUser         uint64 `json:"last_user"`
	AverageAge       int    `json:"average_age"`
	PopularCity      string `json:"popular_city"`
	PopularName      string `json:"popular_name"`
	PopularSupporter int64  `json:"popular_supporter"`
}

type UserService interface {
	CreateUser(ctx context.Context, user User) error
	GetUser(ctx context.Context, id uint64) (User, error)
	UpdateUser(ctx context.Context, user User) error
	DeleteUser(ctx context.Context, id uint64) error

	PrettyStats(ctx context.Context) (PrettyStats, error)
}

type service struct {
	repo UserRepository
}

func NewUserService(repo UserRepository) UserService {
	return &service{repo: repo}
}

func (s *service) CreateUser(ctx context.Context, user User) error {
	u, _ := s.repo.GetUser(ctx, user.ID)
	if u.ID != 0 {
		return s.UpdateUser(ctx, user)
	}
	return s.repo.CreateUser(ctx, user)
}

func (s *service) GetUser(ctx context.Context, id uint64) (User, error) {
	return s.repo.GetUser(ctx, id)
}

func (s *service) UpdateUser(ctx context.Context, user User) error {
	u, _ := s.repo.GetUser(ctx, user.ID)
	if u.ID == 0 {
		return s.CreateUser(ctx, user)
	}
	return s.repo.UpdateUser(ctx, user)
}

func (s *service) DeleteUser(ctx context.Context, id uint64) error {
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
		popularSupporter int64
	)

	var (
		counterCity    = make(map[string]int)
		counterName    = make(map[string]int)
		supportCounter = make(map[int64]int)
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
		supportCounter[int64(user.AddedBy)]++
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

	pretty.TotalUsers = int64(len(all))
	pretty.LastUser = all[len(all)-1].ID
	pretty.AverageAge = averageAge
	pretty.PopularCity = popularCity
	pretty.PopularName = popularName
	pretty.PopularSupporter = popularSupporter

	return pretty, nil
}
