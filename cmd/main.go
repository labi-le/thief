package main

import (
	"context"
	"database/sql"
	"github.com/diamondburned/arikawa/v3/gateway"
	"github.com/diamondburned/arikawa/v3/state"
	"github.com/pkg/errors"
	"github.com/sethvargo/go-envconfig"
	"github.com/sirupsen/logrus"
	_ "modernc.org/sqlite"
	"os"
	"os/signal"
	"thief/internal"
	"time"
)

var (
	logger      = initLogger()
	ctx, cancel = signal.NotifyContext(context.Background(), os.Interrupt)
)

func main() {
	defer cancel()

	var conf internal.Config
	if err := envconfig.Process(ctx, &conf); err != nil {
		panic(errors.Wrap(err, "failed to load config"))
	}

	logger.Info("start thief")

	logger.Infof("config: %v", conf)

	logger.Info("init bot")
	bot := state.New("Bot " + conf.AccessToken)
	bot.AddIntents(
		gateway.IntentGuilds |
			gateway.IntentGuildPresences |
			gateway.IntentGuildMessages |
			gateway.IntentGuildMembers,
	)

	logger.Info("init db")
	ur := internal.NewUserRepository(MustDB(conf.DBConn))
	us := MustUserService(ur)

	logger.Info("register handlers")
	internal.RegisterHandlers(bot, logger, us, conf)

	defer bot.Close()

	if err := bot.Open(ctx); err != nil {
		logger.Error(errors.Wrap(err, "failed to open bot"))
	}

	//logger.Info("init job")
	//service := MustStateService(conf, ur, bot)
	//go service.RunJob(ctx)

	<-ctx.Done()
}

func MustDB(dbConn string) *sql.DB {
	db, err := sql.Open("sqlite", dbConn)
	if err != nil {
		panic(err)
	}

	return db
}

func MustUserService(ur internal.UserRepository) internal.UserService {
	return internal.NewUserService(ur)
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
		logger,
	)
}

func initLogger() *logrus.Logger {
	logger := logrus.New()
	logger.SetLevel(logrus.DebugLevel)
	//logger.SetFormatter(&logrus.JSONFormatter{
	//	PrettyPrint: false,
	//})
	logger.SetFormatter(&logrus.TextFormatter{FullTimestamp: true})

	logger.SetReportCaller(true)
	return logger
}
