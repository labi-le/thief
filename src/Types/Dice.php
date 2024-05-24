<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class Dice
 * This object represents an animated emoji that displays a random value.
 */
class Dice extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['emoji', 'value'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'emoji' => true,
        'value' => true
    ];

    /**
     * Emoji on which the dice throw animation is based
     *
     * @var string
     */
    protected string $emoji;

    /**
     * Value of the dice, 1-6 for “🎲” and “🎯” base emoji, 1-5 for “🏀” and “⚽” base emoji, 1-64 for “🎰” base emoji
     *
     * @var int
     */
    protected int $value;

    /**
     * @return string
     */
    public function getEmoji(): string
    {
        return $this->emoji;
    }

    /**
     * @param string $emoji
     * @return void
     */
    public function setEmoji(string $emoji): void
    {
        $this->emoji = $emoji;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
