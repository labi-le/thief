<?php
declare(strict_types=1);

namespace labile\thief\Types;


use const E_USER_DEPRECATED;

/**
 * Class PollAnswer
 *
 * @see https://core.telegram.org/bots/api#pollanswer
 *
 * This object represents an answer of a user in a non-anonymous poll.
 *
 *
 */
class PollAnswer extends BaseType
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
     * @deprecated
     *
     * @return User
     */
    public function getFrom(): User
    {
        @trigger_error(sprintf('Access user with %s is deprecated, use "%s::getUser" method', __METHOD__, __CLASS__), E_USER_DEPRECATED);

        return $this->getUser();
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
