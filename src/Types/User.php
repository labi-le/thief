<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class User
 * This object represents a Telegram user or bot.
 *
 */
class User extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['id', 'first_name'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'first_name' => true,
        'last_name' => true,
        'username' => true,
        'language_code' => true,
        'is_premium' => true,
        'added_to_attachment_menu' => true,
        'can_join_groups' => true,
        'can_read_all_group_messages' => true,
        'supports_inline_queries' => true,
        'is_bot' => true
    ];

    /**
     * Unique identifier for this user or bot
     *
     * @var int|float
     */
    protected int|float $id;

    /**
     * User‘s or bot’s first name
     *
     * @var string
     */
    protected string $firstName;

    /**
     * Optional. User‘s or bot’s last name
     *
     * @var string|null
     */
    protected ?string $lastName;

    /**
     * Optional. User‘s or bot’s username
     *
     * @var string|null
     */
    protected ?string $username;

    /**
     * Optional. IETF language tag of the user's language
     *
     * @var string|null
     */
    protected ?string $languageCode;

    /**
     * True, if this user is a bot
     *
     * @var bool
     */
    protected bool $isBot;

    /**
     * Optional. True, if this user is a Telegram Premium user
     *
     * @var bool|null
     */
    protected ?bool $isPremium;

    /**
     * Optional. True, if this user added the bot to the attachment menu
     *
     * @var bool|null
     */
    protected ?bool $addedToAttachmentMenu;

    /**
     * Optional. True, if the bot can be invited to groups. Returned only in getMe.
     *
     * @var bool|null
     */
    protected ?bool $canJoinGroups;

    /**
     * Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     *
     * @var bool|null
     */
    protected ?bool $canReadAllGroupMessages;

    /**
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     *
     * @var bool|null
     */
    protected ?bool $supportsInlineQueries;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return int|float
     */
    public function getId(): float|int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setId(mixed $id): void
    {
        if (is_integer($id) || is_float($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return null|string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return null|string
     */
    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    /**
     * @param string $languageCode
     *
     * @return void
     */
    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @param bool $isBot
     *
     * @return void
     */
    public function setIsBot(bool $isBot): void
    {
        $this->isBot = $isBot;
    }

    /**
     * @param bool $isPremium
     *
     * @return void
     */
    public function setIsPremium(bool $isPremium): void
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @return bool|null
     */
    public function getIsPremium(): ?bool
    {
        return $this->isPremium;
    }

    /**
     * @param bool $addedToAttachmentMenu
     *
     * @return void
     */
    public function setAddedToAttachmentMenu(bool $addedToAttachmentMenu): void
    {
        $this->addedToAttachmentMenu = $addedToAttachmentMenu;
    }

    /**
     * @return bool|null
     */
    public function getAddedToAttachmentMenu(): ?bool
    {
        return $this->addedToAttachmentMenu;
    }

    /**
     * @param bool $canJoinGroups
     *
     * @return void
     */
    public function setCanJoinGroups(bool $canJoinGroups): void
    {
        $this->canJoinGroups = $canJoinGroups;
    }

    /**
     * @return bool|null
     */
    public function getCanJoinGroups(): ?bool
    {
        return $this->canJoinGroups;
    }

    /**
     * @param bool $canReadAllGroupMessages
     *
     * @return void
     */
    public function setCanReadAllGroupMessages(bool $canReadAllGroupMessages): void
    {
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanReadAllGroupMessages(): ?bool
    {
        return $this->canReadAllGroupMessages;
    }

    /**
     * @param bool $supportsInlineQueries
     *
     * @return void
     */
    public function setSupportsInlineQueries(bool $supportsInlineQueries): void
    {
        $this->supportsInlineQueries = $supportsInlineQueries;
    }

    /**
     * @return bool|null
     */
    public function getSupportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }

}
