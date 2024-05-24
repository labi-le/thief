<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user.
 * Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram.
 */
class LoginUrl extends BaseType implements TypeInterface
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['url'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'url' => true,
        'forward_text' => true,
        'bot_username' => true,
        'request_write_access' => true
    ];

    /**
     * An HTTP URL to be opened with user authorization data added to the query string when the button is pressed.
     *
     * @var string
     */
    protected string $url;

    /**
     * Optional. New text of the button in forwarded messages.
     *
     * @var string|null
     */
    protected ?string $forwardText;

    /**
     * Optional. Username of a bot, which will be used for user authorization
     *
     * @var string|null
     */
    protected ?string $botUsername;

    /**
     * Optional. Pass True to request the permission for your bot to send messages to the user.
     *
     * @var bool|null
     */
    protected ?bool $requestWriteAccess;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getForwardText(): ?string
    {
        return $this->forwardText;
    }

    /**
     * @param string $forwardText
     * @return void
     */
    public function setForwardText(string $forwardText): void
    {
        $this->forwardText = $forwardText;
    }

    /**
     * @return null|string
     */
    public function getBotUsername(): ?string
    {
        return $this->botUsername;
    }

    /**
     * @param string $botUsername
     * @return void
     */
    public function setBotUsername(string $botUsername): void
    {
        $this->botUsername = $botUsername;
    }

    /**
     * @return bool|null
     */
    public function isRequestWriteAccess(): ?bool
    {
        return $this->requestWriteAccess;
    }

    /**
     * @param bool $requestWriteAccess
     * @return void
     */
    public function setRequestWriteAccess(bool $requestWriteAccess): void
    {
        $this->requestWriteAccess = $requestWriteAccess;
    }
}
