<?php

declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class Poll
 * This object contains information about a poll.
 *
 */
class Poll extends BaseType implements TypeInterface, Event
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = [
        'id',
        'question',
        'options',
        'total_voter_count',
        'is_closed',
        'is_anonymous',
        'type',
        'allows_multiple_answers',
    ];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'question' => true,
        'options' => ArrayOfPollOption::class,
        'total_voter_count' => true,
        'is_closed' => true,
        'is_anonymous' => true,
        'type' => true,
        'allows_multiple_answers' => true,
        'correct_option_id' => true,
    ];

    /**
     * Unique poll identifier
     *
     * @var string
     */
    protected string $id;

    /**
     * Poll question, 1-255 characters
     *
     * @var string
     */
    protected string $question;

    /**
     * List of poll options
     * Array of \TelegramBot\Api\Types\PollOption
     *
     * @var array
     */
    protected array $options;

    /**
     * Total number of users that voted in the poll
     *
     * @var int
     */
    protected int $totalVoterCount;

    /**
     * True, if the poll is closed
     *
     * @var bool
     */
    protected bool $isClosed;

    /**
     * True, if the poll is anonymous
     *
     * @var bool
     */
    protected bool $isAnonymous;

    /**
     * Poll type, currently can be “regular” or “quiz”
     *
     * @var string
     */
    protected string $type;

    /**
     * True, if the poll allows multiple answers
     *
     * @var bool
     */
    protected bool $allowsMultipleAnswers;

    /**
     * Optional. 0-based identifier of the correct answer option.
     * Available only for polls in the quiz mode, which are closed, or was sent (not forwarded)
     * by the bot or to the private chat with the bot.
     *
     * @var int|null
     */
    protected ?int $correctOptionId;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return void
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return int
     */
    public function getTotalVoterCount(): int
    {
        return $this->totalVoterCount;
    }

    /**
     * @param int $totalVoterCount
     * @return void
     */
    public function setTotalVoterCount(int $totalVoterCount): void
    {
        $this->totalVoterCount = $totalVoterCount;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    /**
     * @param bool $isClosed
     * @return void
     */
    public function setIsClosed(bool $isClosed): void
    {
        $this->isClosed = $isClosed;
    }

    /**
     * @return bool
     */
    public function isAnonymous(): bool
    {
        return $this->isAnonymous;
    }

    /**
     * @param bool $isAnonymous
     * @return void
     */
    public function setIsAnonymous(bool $isAnonymous): void
    {
        $this->isAnonymous = $isAnonymous;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isAllowsMultipleAnswers(): bool
    {
        return $this->allowsMultipleAnswers;
    }

    /**
     * @param bool $allowsMultipleAnswers
     * @return void
     */
    public function setAllowsMultipleAnswers(bool $allowsMultipleAnswers): void
    {
        $this->allowsMultipleAnswers = $allowsMultipleAnswers;
    }

    /**
     * @return int|null
     */
    public function getCorrectOptionId(): ?int
    {
        return $this->correctOptionId;
    }

    /**
     * @param int $correctOptionId
     * @return void
     */
    public function setCorrectOptionId(int $correctOptionId): void
    {
        $this->correctOptionId = $correctOptionId;
    }
}
