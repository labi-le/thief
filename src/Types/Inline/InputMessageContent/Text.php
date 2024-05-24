<?php
declare(strict_types=1);


namespace labile\thief\Types\Inline\InputMessageContent;

use labile\thief\Types\Inline\InputMessageContent;
use labile\thief\Types\TypeInterface;

/**
 * Class Text
 * @see https://core.telegram.org/bots/api#inputtextmessagecontent
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 */
class Text extends InputMessageContent implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['message_text'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'message_text' => true,
        'parse_mode' => true,
        'disable_web_page_preview' => true,
    ];

    /**
     * Text of the message to be sent, 1-4096 characters
     *
     * @var string
     */
    protected string $messageText;

    /**
     * Optional. Send Markdown or HTML,
     * if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     *
     * @var string|null
     */
    protected ?string $parseMode;

    /**
     * Optional. Disables link previews for links in the sent message
     *
     * @var bool|null
     */
    protected ?bool $disableWebPagePreview;

    /**
     * Text constructor.
     * @param string $messageText
     * @param string|null $parseMode
     * @param bool $disableWebPagePreview
     */
    public function __construct(string $messageText, string $parseMode = null, bool $disableWebPagePreview = false)
    {
        $this->messageText = $messageText;
        $this->parseMode = $parseMode;
        $this->disableWebPagePreview = $disableWebPagePreview;
    }

    /**
     * @return string
     */
    public function getMessageText(): string
    {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     *
     * @return void
     */
    public function setMessageText(string $messageText): void
    {
        $this->messageText = $messageText;
    }

    /**
     * @return string|null
     */
    public function getParseMode(): ?string
    {
        return $this->parseMode;
    }

    /**
     * @param string|null $parseMode
     *
     * @return void
     */
    public function setParseMode(?string $parseMode): void
    {
        $this->parseMode = $parseMode;
    }

    /**
     * @return bool|null
     */
    public function isDisableWebPagePreview(): ?bool
    {
        return $this->disableWebPagePreview;
    }

    /**
     * @param bool|null $disableWebPagePreview
     *
     * @return void
     */
    public function setDisableWebPagePreview(?bool $disableWebPagePreview): void
    {
        $this->disableWebPagePreview = $disableWebPagePreview;
    }
}
