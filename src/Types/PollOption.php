<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class PollOption
 * This object contains information about one answer option in a poll.
 *
 */
class PollOption extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['text', 'voter_count'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'text' => true,
        'voter_count' => true
    ];

    /**
     * Option text, 1-100 characters
     *
     * @var string
     */
    protected string $text;

    /**
     * Number of users that voted for this option
     *
     * @var integer
     */
    protected int $voterCount;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getVoterCount(): int
    {
        return $this->voterCount;
    }

    /**
     * @param int $voterCount
     * @return void
     */
    public function setVoterCount(int $voterCount): void
    {
        $this->voterCount = $voterCount;
    }
}
