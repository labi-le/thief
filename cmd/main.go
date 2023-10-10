package main

import (
	"context"
	"database/sql"
	"github.com/diamondburned/arikawa/v3/gateway"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/patrickmn/go-cache"
	"github.com/pkg/errors"
	"github.com/rs/zerolog"
	"github.com/rs/zerolog/log"
	"github.com/sethvargo/go-envconfig"
	_ "modernc.org/sqlite"
	"os"
	"os/signal"
	"thief/internal"
	"time"
)

var (
	ctx, cancel = signal.NotifyContext(context.Background(), os.Interrupt)
)

func main() {
	defer cancel()

	var conf internal.Config
	if err := envconfig.Process(ctx, &conf); err != nil {
		panic(errors.Wrap(err, "failed to load config"))
	}

	log.Info().Msg("start thief")
	log.Info().Msgf("config: %v", conf)
	log.Info().Msgf("version: %s", internal.BuildVersion())

	log.Info().Msg("init bot")
	bot := state.New("Bot " + conf.AccessToken)
	bot.AddIntents(
		gateway.IntentGuilds |
			gateway.IntentGuildPresences |
			gateway.IntentGuildMessages |
			gateway.IntentGuildMembers,
	)

	log.Info().Msg("init db")
	ur := internal.NewUserRepository(MustDB(conf.DBConn))
	us := MustUserService(ur, bot)

	log.Info().Msg("register handlers")
	internal.RegisterHandlers(bot, us, conf)

	defer bot.Close()

	if err := bot.Open(ctx); err != nil {
		log.Err(err).Msg("failed to open bot")
	}

	log.Info().Msg("init job")
	service := MustStateService(conf, ur, bot)
	go func() {
		err := service.RunJob(ctx)
		if err != nil {
			log.Err(err).Msg("failed to run job")
		}
	}()

	<-ctx.Done()
}

func MustDB(dbConn string) *sql.DB {
	db, err := sql.Open("sqlite", dbConn)
	if err != nil {
		panic(err)
	}

	return db
}

func MustUserService(ur internal.UserRepository, bot *state.State) internal.UserService {
	return internal.NewUserService(ur, bot, cache.New(5*time.Minute, 10*time.Minute))
}

func MustStateService(
	c internal.Config,
	ur internal.UserRepository,
	bot *state.State,
) internal.StateService {
	return internal.NewStateService(
		time.Duration(c.Timeout),
		c.GuildID,
		ur,
		bot,
	)
}

func initLogger(debug bool) {
	if debug {
		log.Logger = log.With().Caller().Logger()
		zerolog.SetGlobalLevel(zerolog.TraceLevel)
		return
	}

	zerolog.SetGlobalLevel(zerolog.InfoLevel)
}
