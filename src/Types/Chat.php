<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

class Chat extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['id', 'type'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'type' => true,
        'title' => true,
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'photo' => ChatPhoto::class,
        'bio' => true,
        'description' => true,
        'invite_link' => true,
        'pinned_message' => Message::class,
        'permissions' => ChatPermissions::class,
        'slow_mode_delay' => true,
        'sticker_set_name' => true,
        'can_set_sticker_set' => true,
        'linked_chat_id' => true,
        'location' => ChatLocation::class,
        'join_to_send_messages' => true,
        'join_by_request' => true,
        'message_auto_delete_time' => true,
        'has_protected_content' => true,
        'is_forum' => true,
        'active_usernames' => true,
        'emoji_status_custom_emoji_id' => true,
        'has_private_forwards' => true,
        'has_restricted_voice_and_video_messages' => true,
    ];

    /**
     * Unique identifier for this chat, not exceeding 1e13 by absolute value
     *
     * @var int|float|string
     */
    protected string|int|float $id;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     *
     * @var string
     */
    protected string $type;

    /**
     * Optional. Title, for channels and group chats
     *
     * @var string|null
     */
    protected ?string $title;

    /**
     * Optional. Username, for private chats and channels if available
     *
     * @var string|null
     */
    protected ?string $username;

    /**
     * Optional. First name of the other party in a private chat
     *
     * @var string|null
     */
    protected ?string $firstName;

    /**
     * Optional. Last name of the other party in a private chat
     *
     * @var string|null
     */
    protected ?string $lastName;

    /**
     * Optional. Chat photo. Returned only in getChat.
     *
     * @var ChatPhoto|null
     */
    protected ?ChatPhoto $photo;

    /**
     * Optional. Bio of the other party in a private chat. Returned only in getChat
     *
     * @var string|null
     */
    protected ?string $bio;

    /**
     * Optional. Description, for supergroups and channel chats. Returned only in getChat.
     *
     * @var string|null
     */
    protected ?string $description;

    /**
     * Optional. Chat invite link, for supergroups and channel chats. Returned only in getChat.
     *
     * @var string|null
     */
    protected ?string $inviteLink;

    /**
     * Optional. Pinned message, for supergroups. Returned only in getChat.
     *
     * @var Message|null
     */
    protected ?Message $pinnedMessage;

    /**
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     *
     * @var ChatPermissions|null
     */
    protected ?ChatPermissions $permissions;

    /**
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged
     * user. Returned only in getChat.
     *
     * @var int|null
     */
    protected ?int $slowModeDelay;

    /**
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     *
     * @var string|null
     */
    protected ?string $stickerSetName;

    /**
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $canSetStickerSet;

    /**
     * Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice
     * versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming
     * languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64
     * bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
     *
     * @var int|null
     */
    protected ?int $linkedChatId;

    /**
     * Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
     *
     * @var ChatLocation|null
     */
    protected ?ChatLocation $location;

    /**
     * Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $joinToSendMessages;

    /**
     * Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $joinByRequest;

    /**
     * Optional. Time after which all messages sent to the chat will be automatically deleted; in seconds. Returned
     * only in getChat.
     *
     * @var int|null
     */
    protected ?int $messageAutoDeleteTime;

    /**
     * 	Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $hasProtectedContent;

    /**
     * Optional. True, if the supergroup chat is a forum (has topics enabled)
     *
     * @var bool|null
     */
    protected ?bool $isForum;

    /**
     * Optional. If non-empty, the list of all active chat usernames;
     * for private chats, supergroups and channels. Returned only in getChat.
     *
     * @var array[]|null
     */
    protected ?array $activeUsernames;

    /**
     * Optional. Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
     *
     * @var string|null
     */
    protected ?string $emojiStatusCustomEmojiId;

    /**
     * Optional. True, if privacy settings of the other party in the private chat allows
     * to use tg://user?id=<user_id> links only in chats with the user.
     * Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $hasPrivateForwards;

    /**
     * Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat.
     * Returned only in getChat.
     *
     * @var bool|null
     */
    protected ?bool $hasRestrictedVoiceAndVideoMessages;

    /**
     * @return int|float|string
     */
    public function getId(): float|int|string
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return void
     * @throws InvalidArgumentException
     */
    public function setId(mixed $id): void
    {
        if (is_integer($id) || is_float($id) || is_string($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException();
        }
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
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
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
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return ChatPhoto|null
     */
    public function getPhoto(): ?ChatPhoto
    {
        return $this->photo;
    }

    /**
     * @param ChatPhoto $photo
     * @return void
     */
    public function setPhoto(ChatPhoto $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return null|string
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     * @return void
     */
    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getInviteLink(): ?string
    {
        return $this->inviteLink;
    }

    /**
     * @param string $inviteLink
     * @return void
     */
    public function setInviteLink(string $inviteLink): void
    {
        $this->inviteLink = $inviteLink;
    }

    /**
     * @return Message|null
     */
    public function getPinnedMessage(): ?Message
    {
        return $this->pinnedMessage;
    }

    /**
     * @param Message $pinnedMessage
     * @return void
     */
    public function setPinnedMessage(Message $pinnedMessage): void
    {
        $this->pinnedMessage = $pinnedMessage;
    }

    /**
     * @return ChatPermissions|null
     */
    public function getPermissions(): ?ChatPermissions
    {
        return $this->permissions;
    }

    /**
     * @param ChatPermissions $permissions
     * @return void
     */
    public function setPermissions(ChatPermissions $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return int|null
     */
    public function getSlowModeDelay(): ?int
    {
        return $this->slowModeDelay;
    }

    /**
     * @param int $slowModeDelay
     * @return void
     */
    public function setSlowModeDelay(int $slowModeDelay): void
    {
        $this->slowModeDelay = $slowModeDelay;
    }

    /**
     * @return null|string
     */
    public function getStickerSetName(): ?string
    {
        return $this->stickerSetName;
    }

    /**
     * @param string $stickerSetName
     * @return void
     */
    public function setStickerSetName(string $stickerSetName): void
    {
        $this->stickerSetName = $stickerSetName;
    }

    /**
     * @return bool|null
     */
    public function getCanSetStickerSet(): ?bool
    {
        return $this->canSetStickerSet;
    }

    /**
     * @param bool $canSetStickerSet
     * @return void
     */
    public function setCanSetStickerSet(bool $canSetStickerSet): void
    {
        $this->canSetStickerSet = $canSetStickerSet;
    }

    /**
     * @return int|null
     */
    public function getLinkedChatId(): ?int
    {
        return $this->linkedChatId;
    }

    /**
     * @param int $linkedChatId
     * @return void
     */
    public function setLinkedChatId(int $linkedChatId): void
    {
        $this->linkedChatId = $linkedChatId;
    }

    /**
     * @return ChatLocation|null
     */
    public function getLocation(): ?ChatLocation
    {
        return $this->location;
    }

    /**
     * @param ChatLocation $location
     * @return void
     */
    public function setLocation(ChatLocation $location): void
    {
        $this->location = $location;
    }

    /**
     * @return bool|null
     */
    public function getJoinToSendMessages(): ?bool
    {
        return $this->joinToSendMessages;
    }

    /**
     * @param bool $joinToSendMessages
     * @return void
     */
    public function setJoinToSendMessages(bool $joinToSendMessages): void
    {
        $this->joinToSendMessages = $joinToSendMessages;
    }

    /**
     * @return bool|null
     */
    public function getJoinByRequest(): ?bool
    {
        return $this->joinByRequest;
    }

    /**
     * @param bool $joinByRequest
     * @return void
     */
    public function setJoinByRequest(bool $joinByRequest): void
    {
        $this->joinByRequest = $joinByRequest;
    }

    /**
     * @return int|null
     */
    public function getMessageAutoDeleteTime(): ?int
    {
        return $this->messageAutoDeleteTime;
    }

    /**
     * @param int $messageAutoDeleteTime
     * @return void
     */
    public function setMessageAutoDeleteTime(int $messageAutoDeleteTime): void
    {
        $this->messageAutoDeleteTime = $messageAutoDeleteTime;
    }

    /**
     * @return bool|null
     */
    public function getHasProtectedContent(): ?bool
    {
        return $this->hasProtectedContent;
    }

    /**
     * @param bool $hasProtectedContent
     * @return void
     */
    public function setHasProtectedContent(bool $hasProtectedContent): void
    {
        $this->hasProtectedContent = $hasProtectedContent;
    }

    /**
     * @return bool|null
     */
    public function getIsForum(): ?bool
    {
        return $this->isForum;
    }

    /**
     * @param bool $isForum
     * @return void
     */
    public function setIsForum(bool $isForum): void
    {
        $this->isForum = $isForum;
    }

    /**
     * @return array[]|null
     *
     * @psalm-return array<array>|null
     */
    public function getActiveUsernames(): ?array
    {
        return $this->activeUsernames;
    }

    /**
     * @param array $activeUsernames
     * @return void
     */
    public function setActiveUsernames(array $activeUsernames): void
    {
        $this->activeUsernames = $activeUsernames;
    }

    /**
     * @return null|string
     */
    public function getEmojiStatusCustomEmojiId(): ?string
    {
        return $this->emojiStatusCustomEmojiId;
    }

    /**
     * @param string $emojiStatusCustomEmojiId
     * @return void
     */
    public function setEmojiStatusCustomEmojiId(string $emojiStatusCustomEmojiId): void
    {
        $this->emojiStatusCustomEmojiId = $emojiStatusCustomEmojiId;
    }

    /**
     * @return bool|null
     */
    public function getHasPrivateForwards(): ?bool
    {
        return $this->hasPrivateForwards;
    }

    /**
     * @param bool $hasPrivateForwards
     * @return void
     */
    public function setHasPrivateForwards(bool $hasPrivateForwards): void
    {
        $this->hasPrivateForwards = $hasPrivateForwards;
    }

    /**
     * @return bool|null
     */
    public function getHasRestrictedVoiceAndVideoMessages(): ?bool
    {
        return $this->hasRestrictedVoiceAndVideoMessages;
    }

    /**
     * @param bool $hasRestrictedVoiceAndVideoMessages
     * @return void
     */
    public function setHasRestrictedVoiceAndVideoMessages(bool $hasRestrictedVoiceAndVideoMessages): void
    {
        $this->hasRestrictedVoiceAndVideoMessages = $hasRestrictedVoiceAndVideoMessages;
    }
}
