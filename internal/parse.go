package internal

import (
	"github.com/diamondburned/arikawa/v3/discord"
	"github.com/hashicorp/go-multierror"
	"thief/pkg/formatter"
	"thief/pkg/validator"
)

func ParseUserID(data discord.CommandInteractionOptions) (UserID, error) {
	value, err := data.Find(UsernameTag).SnowflakeValue()
	return UserID(value), err
}

func ParseUser(opt discord.CommandInteractionOptions) (User, error) {
	var (
		user           = User{}
		errAccumulator error
	)

	if err := validator.ValidateDiscord(nicknameField, opt, &user.ID); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(ageField, opt, &user.Age); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(nameField, opt, &user.Name); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(locationField, opt, &user.Location); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(hobbiesField, opt, &user.Hobbies); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(occupationField, opt, &user.Occupation); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(goalsField, opt, &user.Goals); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if errAccumulator != nil {
		errAccumulator.(*multierror.Error).ErrorFormat = formatter.Error
	}

	return user, errAccumulator
}

func ParseKeyword(options discord.CommandInteractionOptions) (Keyword, error) {
	var (
		kw             Keyword
		errAccumulator error
	)

	if err := validator.ValidateDiscord(keywordField, options, &kw.Search); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(keywordLimitField, options, &kw.Limit); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if err := validator.ValidateDiscord(keywordOffsetField, options, &kw.Offset); err != nil {
		errAccumulator = multierror.Append(errAccumulator, err)
	}

	if errAccumulator != nil {
		errAccumulator.(*multierror.Error).ErrorFormat = formatter.Error
	}

	return kw, errAccumulator
}
