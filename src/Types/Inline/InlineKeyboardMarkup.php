<?php
declare(strict_types=1);


namespace labile\thief\Types\Inline;


use labile\thief\Types\BaseType;

class InlineKeyboardMarkup extends BaseType
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['inline_keyboard'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'inline_keyboard' => true,
    ];

    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * Array of Array of InlineKeyboardButton
     *
     * @var array
     */
    protected array $inlineKeyboard;

    /**
     * @param array $inlineKeyboard
     */
    public function __construct(array $inlineKeyboard = [])
    {
        $this->inlineKeyboard = $inlineKeyboard;
    }

    /**
     * @return array
     */
    public function getInlineKeyboard(): array
    {
        return $this->inlineKeyboard;
    }

    /**
     * @param array $inlineKeyboard
     *
     * @return void
     */
    public function setInlineKeyboard(array $inlineKeyboard): void
    {
        $this->inlineKeyboard = $inlineKeyboard;
    }
}
