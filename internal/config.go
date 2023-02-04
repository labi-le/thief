package internal

type Config struct {
	AccessToken   string          `env:"ACCESS_TOKEN,required"`
	DBConn        string          `env:"DB_CONN,required"`
	GuildID       GuildID         `env:"GUILD_ID,required"`
	Timeout       int             `env:"TIMEOUT,required"`
	SupportRoleID []SupportRoleID `env:"SUPPORT_ROLE_ID,required,delimiter=;"`
}
