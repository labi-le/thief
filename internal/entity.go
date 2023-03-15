package internal

import "time"

type (
	UserID uint64
	RoleID uint64
)

type User struct {
	ID         UserID    `json:"id" discord:"id"`
	Name       string    `json:"name" pretty:"Имя"`
	Age        int       `json:"age" pretty:"Возраст"`
	Location   string    `json:"location" pretty:"Город"`
	Hobbies    string    `json:"hobbies" pretty:"Хобби"`
	Occupation string    `json:"occupation" pretty:"Род занятий"`
	Goals      string    `json:"goals" pretty:"Цели"`
	AddedBy    UserID    `json:"added_by" discord:"id" pretty:"Добавил"`
	CreatedAt  time.Time `json:"created_at" pretty:"Время создания анкеты"`
}

type Config struct {
	AccessToken   string   `env:"ACCESS_TOKEN,required"`
	DBConn        string   `env:"DB_CONN,required"`
	GuildID       GuildID  `env:"GUILD_ID,required"`
	Timeout       int      `env:"TIMEOUT,required"`
	SupportRoleID []RoleID `env:"SUPPORT_ROLE_ID,required,delimiter=;"`
	MemberRoleID  []RoleID `env:"MEMBER_ROLE_ID,required,delimiter=;"`
}

type PrettyStats struct {
	TotalUsers       uint64 `json:"total_users" pretty:"Всего пользователей"`
	LastUser         UserID `json:"last_user" discord:"id" pretty:"Последняя добавленная анкета"`
	AverageAge       uint8  `json:"average_age" pretty:"Средний возраст"`
	PopularLocation  string `json:"popular_city" pretty:"Популярный город"`
	PopularName      string `json:"popular_name" pretty:"Популярное имя"`
	PopularSupporter UserID `json:"popular_supporter" discord:"id" pretty:"Добавил больше всего пользователей"`
	Under18          uint64 `json:"under_18" pretty:"Количество пользователей младше 18"`
	Over18           uint64 `json:"over_18" pretty:"Количество пользователей старше 18"`
}
