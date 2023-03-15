package internal

import (
	"testing"
	"time"
)

func TestOffset(t *testing.T) {
	// Sample data
	vanilla := []User{
		{
			ID:         1,
			Name:       "a",
			Age:        1,
			Location:   "a",
			Hobbies:    "a",
			Occupation: "a",
			Goals:      "a",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         2,
			Name:       "b",
			Age:        2,
			Location:   "b",
			Hobbies:    "b",
			Occupation: "b",
			Goals:      "b",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         3,
			Name:       "c",
			Age:        3,
			Location:   "c",
			Hobbies:    "c",
			Occupation: "c",
			Goals:      "c",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         4,
			Name:       "d",
			Age:        4,
			Location:   "d",
			Hobbies:    "d",
			Occupation: "d",
			Goals:      "d",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         5,
			Name:       "e",
			Age:        5,
			Location:   "e",
			Hobbies:    "e",
			Occupation: "e",
			Goals:      "e",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         6,
			Name:       "f",
			Age:        6,
			Location:   "f",
			Hobbies:    "f",
			Occupation: "f",
			Goals:      "f",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         7,
			Name:       "g",
			Age:        7,
			Location:   "g",
			Hobbies:    "g",
			Occupation: "g",
			Goals:      "g",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         8,
			Name:       "h",
			Age:        8,
			Location:   "h",
			Hobbies:    "h",
			Occupation: "h",
			Goals:      "h",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         9,
			Name:       "i",
			Age:        9,
			Location:   "i",
			Hobbies:    "i",
			Occupation: "i",
			Goals:      "i",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},

		{
			ID:         10,
			Name:       "j",
			Age:        10,
			Location:   "j",
			Hobbies:    "j",
			Occupation: "j",
			Goals:      "j",
			AddedBy:    0,
			CreatedAt:  time.Time{},
		},
	}

	users := vanilla

	// Test 1
	limit := 2
	offset := 1
	expectedResult := users[1:3]
	Offset(limit, offset, &users)
	if len(users) != 2 {
		t.Errorf("Expected length %d, but got %d", 2, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

	// Test 2
	limit = 4
	offset = 4
	expectedResult = users[4:8]
	Offset(limit, offset, &users)
	if len(users) != 4 {
		t.Errorf("Expected length %d, but got %d", 4, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

	// Test 3 - with limit=0
	limit = 0
	offset = 4
	expectedResult = users[4:9]
	Offset(limit, offset, &users)
	if len(users) != 5 {
		t.Errorf("Expected length %d, but got %d", 5, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

	// Test 4 - with Offset=0
	limit = 2
	offset = 0
	expectedResult = users[0:2]
	Offset(limit, offset, &users)
	if len(users) != 2 {
		t.Errorf("Expected length %d, but got %d", 2, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

	// Test 5 - with Offset=0 and limit=0
	limit = 0
	offset = 0
	expectedResult = users
	Offset(limit, offset, &users)
	if len(users) != 5 {
		t.Errorf("Expected length %d, but got %d", 5, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

	// Test 6 - with Offset=-1 and limit=-1
	limit = -1
	offset = -1
	expectedResult = users
	Offset(limit, offset, &users)
	if len(users) != 5 {
		t.Errorf("Expected length %d, but got %d", 5, len(users))
	}
	for i, user := range users {
		if user != expectedResult[i] {
			t.Errorf("Expected %v, but got %v", expectedResult[i], user)
		}
	}
	users = vanilla

}
