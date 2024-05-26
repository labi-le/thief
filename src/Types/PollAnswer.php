<?php

declare(strict_types=1);

namespace labile\thief\Types;

/**
 * Class PollAnswer
 *
 * @see https://core.telegram.org/bots/api#pollanswer
 *
 * This object represents an answer of a user in a non-anonymous poll.
 *
 *
 */
class PollAnswer extends BaseType implements Event
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['poll_id', 'option_ids', 'user'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'option_ids' => true,
        'user' => User::class,
        'poll_id' => true,
    ];

    /**
     * @var User
     */
    protected User $user;

    /**
     * @var string
     */
    protected string $pollId;

    /**
     * @var int[]
     */
    protected array $optionIds;

    /**
     * @return string
     */
    public function getPollId(): string
    {
        return $this->pollId;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setPollId(string $id): void
    {
        $this->pollId = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $from
     * @return void
     */
    public function setUser(User $from): void
    {
        $this->user = $from;
    }

    /**
     * @return int[]
     */
    public function getOptionIds(): array
    {
        return $this->optionIds;
    }

    /**
     * @param int[] $optionIds
     * @return void
     */
    public function setOptionIds(array $optionIds): void
    {
        $this->optionIds = $optionIds;
    }
}
