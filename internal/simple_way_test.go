package internal

import (
	"testing"
	"time"
)

func TestOffset(t *testing.T) {
	data := []User{
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

	type args struct {
		limit  int
		offset int
		data   []User
	}

	type wantArgs struct {
		length int
		data   []User
	}

	tests := []struct {
		name string
		args args
		want wantArgs
	}{
		{
			name: "test limit=2, offset=1",
			args: args{
				limit:  2,
				offset: 1,
				data:   data,
			},
			want: wantArgs{
				length: 2,
				data:   data[1:3],
			},
		},

		{
			name: "test limit=4, offset=4",
			args: args{
				limit:  4,
				offset: 4,
				data:   data,
			},
			want: wantArgs{
				length: 4,
				data:   data[4:8],
			},
		},

		{
			name: "test limit=10, offset=0",
			args: args{
				limit:  10,
				offset: 0,
				data:   data,
			},
			want: wantArgs{
				length: 10,
				data:   data[0:10],
			},
		},

		{
			name: "test limit=10, offset=10",
			args: args{
				limit:  10,
				offset: 10,
				data:   data,
			},
			want: wantArgs{
				length: 0,
				data:   []User{},
			},
		},

		{
			name: "test limit=10, offset=11",
			args: args{
				limit:  10,
				offset: 11,
				data:   data,
			},
			want: wantArgs{
				length: 5,
				data:   data[5:10],
			},
		},

		{
			name: "test limit=0, offset=0",
			args: args{
				limit:  0,
				offset: 0,
				data:   data,
			},
			want: wantArgs{
				length: 5,
				data:   data[0:5],
			},
		},

		{
			name: "test limit=0, offset=5",
			args: args{
				limit:  0,
				offset: 5,
				data:   data,
			},
			want: wantArgs{
				length: 5,
				data:   data[5:10],
			},
		},

		{
			name: "test limit=0, offset=10",
			args: args{
				limit:  0,
				offset: 10,
				data:   data,
			},
			want: wantArgs{
				length: 0,
				data:   []User{},
			},
		},

		{
			name: "test limit=-1, offset=0",
			args: args{
				limit:  -1,
				offset: 0,
				data:   data,
			},
			want: wantArgs{
				length: 5,
				data:   data[0:5],
			},
		},

		{
			name: "test limit=5, offset=-1",
			args: args{
				limit:  5,
				offset: -1,
				data:   data,
			},
			want: wantArgs{
				length: 5,
				data:   data[0:5],
			},
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			Offset(tt.args.limit, tt.args.offset, &tt.args.data)

			if len(tt.args.data) != tt.want.length {
				t.Errorf("Expected length %d, but got %d", tt.want.length, len(tt.args.data))
			}

			for i, user := range tt.args.data {
				if user != tt.want.data[i] {
					t.Errorf("Expected %v, but got %v", tt.want.data[i], user)
				}
			}

		})
	}
}
