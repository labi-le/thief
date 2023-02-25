package internal

import (
	"context"
	"database/sql"
	"strconv"
	"time"
)

type UserRepository interface {
	CreateUser(ctx context.Context, user User) error
	GetUser(ctx context.Context, id UserID) (User, error)
	UpdateUser(ctx context.Context, user User) error
	DeleteUser(ctx context.Context, id UserID) error
	DeleteUsers(ctx context.Context, id ...UserID) error
	All(ctx context.Context) ([]User, error)
}

func NewUserRepository(db *sql.DB) UserRepository {
	return &repository{db: db}
}

type repository struct {
	db *sql.DB
}

func (r *repository) All(ctx context.Context) ([]User, error) {
	var (
		users []User
	)

	rows, err := r.db.QueryContext(
		ctx,
		`
SELECT id,
       name,
       age,
       location,
       hobbies,
       occupation,
       goals,
       added_by,
       created_at
FROM users
ORDER BY created_at DESC
`)
	if err != nil {
		return users, err
	}

	defer rows.Close()

	for rows.Next() {
		var (
			u       User
			rawTime int64
		)
		err := rows.Scan(
			&u.ID, &u.Name, &u.Age, &u.Location, &u.Hobbies, &u.Occupation, &u.Goals, &u.AddedBy, &rawTime)
		if err != nil {
			return users, err
		}

		u.CreatedAt = time.Unix(rawTime, 0)

		users = append(users, u)
	}

	if len(users) == 0 {
		return users, sql.ErrNoRows
	}

	return users, nil
}

func (r *repository) CreateUser(ctx context.Context, user User) error {
	_, err := r.db.QueryContext(
		ctx,
		`INSERT INTO users (id, name, age, location, hobbies, occupation, goals, added_by, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
		user.ID, user.Name, user.Age, user.Location, user.Hobbies, user.Occupation, user.Goals, user.AddedBy,
		user.CreatedAt.Unix(),
	)

	return err
}

func (r *repository) GetUser(ctx context.Context, id UserID) (User, error) {
	var (
		u       User
		rawTime int64
	)
	errScan := r.db.QueryRowContext(
		ctx,
		`SELECT id, name, age, location, hobbies, occupation, goals, added_by, created_at FROM users WHERE id = ?`,
		id,
	).Scan(&u.ID, &u.Name, &u.Age, &u.Location, &u.Hobbies, &u.Occupation, &u.Goals, &u.AddedBy, &rawTime)

	u.CreatedAt = time.Unix(rawTime, 0)

	return u, errScan
}

func (r *repository) UpdateUser(ctx context.Context, user User) error {
	return r.db.QueryRowContext(
		ctx,
		`UPDATE users SET name = ?, age = ?, location = ?, hobbies = ?, occupation = ?, goals = ? WHERE id = ?`,
		user.Name, user.Age, user.Location, user.Hobbies, user.Occupation, user.Goals, user.ID,
	).Err()
}

func (r *repository) DeleteUser(ctx context.Context, id UserID) error {
	return r.db.QueryRowContext(
		ctx, `DELETE FROM users WHERE id = ?`, id,
	).Err()
}

func (r *repository) DeleteUsers(ctx context.Context, id ...UserID) error {
	ids := "("
	for _, i := range id {
		ids += strconv.FormatUint(uint64(i), 10) + ","
	}

	// replace last comma with closing bracket
	ids = ids[:len(ids)-1] + ")"

	_, err := r.db.ExecContext(ctx, `DELETE FROM users WHERE id IN `+ids)

	return err
}
