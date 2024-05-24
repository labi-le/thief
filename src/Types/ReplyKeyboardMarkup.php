<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class ReplyKeyboardMarkup
 * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 *
 */
class ReplyKeyboardMarkup extends BaseType
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['keyboard'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'keyboard' => true,
        'one_time_keyboard' => true,
        'resize_keyboard' => true,
        'selective' => true,
        'is_persistent' => true,
        'input_field_placeholder' => true,
    ];

    /**
     * Array of button rows, each represented by an Array of Strings
     * Array of Array of String
     *
     * @var array
     */
    protected array $keyboard;

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit
     * (e.g., make the keyboard smaller if there are just two rows of buttons).
     * Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     *
     * @var bool|null
     */
    protected ?bool $resizeKeyboard;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     *
     * @var bool|null
     */
    protected ?bool $oneTimeKeyboard;

    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only.
     * Targets:
     * 1) users that are @mentioned in the text of the Message object;
     * 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     *
     * @var bool|null
     */
    protected ?bool $selective;

    /**
     * Optional. Requests clients to always show the keyboard when the regular keyboard is hidden.
     * Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
     *
     * @var bool|null
     */
    protected ?bool $isPersistent;

    /**
     * Optional. The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
     *
     * @var string|null
     */
    protected ?string $inputFieldPlaceholder;

    /**
     * @param array $keyboard
     * @param bool|null $oneTimeKeyboard
     * @param bool|null $resizeKeyboard
     * @param bool|null $selective
     * @param bool|null $isPersistent
     * @param string|null $inputFieldPlaceholder
     */
    public function __construct(array $keyboard = [], bool $oneTimeKeyboard = null, bool $resizeKeyboard = null, bool $selective = null, bool $isPersistent = null, string $inputFieldPlaceholder = null)
    {
        $this->keyboard = $keyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->resizeKeyboard = $resizeKeyboard;
        $this->selective = $selective;
        $this->isPersistent = $isPersistent;
        $this->inputFieldPlaceholder = $inputFieldPlaceholder;
    }

    /**
     * @return array
     */
    public function getKeyboard(): array
    {
        return $this->keyboard;
    }

    /**
     * @param array $keyboard
     * @return void
     */
    public function setKeyboard(array $keyboard): void
    {
        $this->keyboard = $keyboard;
    }

    /**
     * @return bool|null
     */
    public function isOneTimeKeyboard(): ?bool
    {
        return $this->oneTimeKeyboard;
    }

    /**
     * @param bool $oneTimeKeyboard
     * @return void
     */
    public function setOneTimeKeyboard(bool $oneTimeKeyboard): void
    {
        $this->oneTimeKeyboard = $oneTimeKeyboard;
    }

    /**
     * @return bool|null
     */
    public function isResizeKeyboard(): ?bool
    {
        return $this->resizeKeyboard;
    }

    /**
     * @param bool $resizeKeyboard
     * @return void
     */
    public function setResizeKeyboard(bool $resizeKeyboard): void
    {
        $this->resizeKeyboard = $resizeKeyboard;
    }

    /**
     * @return bool|null
     */
    public function isSelective(): ?bool
    {
        return $this->selective;
    }

    /**
     * @param bool $selective
     * @return void
     */
    public function setSelective(bool $selective): void
    {
        $this->selective = $selective;
    }

    /**
     * @return bool|null
     */
    public function getIsPersistent(): ?bool
    {
        return $this->isPersistent;
    }

    /**
     * @param bool $isPersistent
     * @return void
     */
    public function setIsPersistent(bool $isPersistent): void
    {
        $this->isPersistent = $isPersistent;
    }

    /**
     * @return string|null
     */
    public function getInputFieldPlaceholder(): ?string
    {
        return $this->inputFieldPlaceholder;
    }

    /**
     * @param string|null $inputFieldPlaceholder
     * @return void
     */
    public function setInputFieldPlaceholder(?string $inputFieldPlaceholder): void
    {
        $this->inputFieldPlaceholder = $inputFieldPlaceholder;
    }
}
