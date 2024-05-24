<?php
declare(strict_types=1);

namespace labile\thief\Types;


class ChatMember extends BaseType
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['user', 'status'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'user' => User::class,
        'status' => true,
        'until_date' => true,
        'can_be_edited' => true,
        'can_change_info' => true,
        'can_post_messages' => true,
        'can_edit_messages' => true,
        'can_delete_messages' => true,
        'can_invite_users' => true,
        'can_restrict_members' => true,
        'can_pin_messages' => true,
        'can_promote_members' => true,
        'can_send_messages' => true,
        'can_send_media_messages' => true,
        'can_send_other_messages' => true,
        'can_add_web_page_previews' => true,
        'can_manage_topics' => true,
        'is_anonymous' => true,
        'custom_title' => true,
        'can_manage_chat' => true,
        'can_send_polls' => true,
    ];

    /**
     * Information about the user
     *
     * @var User
     */
    protected User $user;

    /**
     * The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”
     *
     * @var string
     */
    protected string $status;

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user, unix time
     *
     * @var integer|null
     */
    protected ?int $untilDate;

    /**
     * Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user
     *
     * @var bool|null
     */
    protected ?bool $canBeEdited;

    /**
     * Optional. Administrators only. True, if the administrator can change the chat title, photo and other settings
     *
     * @var bool|null
     */
    protected ?bool $canChangeInfo;

    /**
     * Optional. Administrators only. True, if the administrator can post in the channel, channels only
     *
     * @var bool|null
     */
    protected ?bool $canPostMessages;

    /**
     * Optional. Administrators only. True, if the administrator can edit messages of other users, channels only
     *
     * @var bool|null
     */
    protected ?bool $canEditMessages;

    /**
     * Optional. Administrators only. True, if the administrator can delete messages of other users
     *
     * @var bool|null
     */
    protected ?bool $canDeleteMessages;

    /**
     * Optional. Administrators only. True, if the administrator can invite new users to the chat
     *
     * @var bool|null
     */
    protected ?bool $canInviteUsers;

    /**
     * Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members
     *
     * @var bool|null
     */
    protected ?bool $canRestrictMembers;

    /**
     * Optional. Administrators only. True, if the administrator can pin messages, supergroups only
     *
     * @var bool|null
     */
    protected ?bool $canPinMessages;

    /**
     * Optional. Administrators only. True, if the administrator can add new administrators with a subset of his own
     * privileges or demote administrators that he has promoted, directly or indirectly
     * (promoted by administrators that were appointed by the user)
     *
     * @var bool|null
     */
    protected ?bool $canPromoteMembers;

    /**
     * Optional. Restricted only. True, if the user can send text messages, contacts, locations and venues
     *
     * @var bool|null
     */
    protected ?bool $canSendMessages;

    /**
     * Optional. Restricted only. True, if the user can send audios, documents, photos, videos, video notes
     * and voice notes, implies can_send_messages
     *
     * @var bool|null
     */
    protected ?bool $canSendMediaMessages;

    /**
     * Optional. Restricted only. True, if the user can send animations, games, stickers and use inline bots,
     * implies can_send_media_messages
     *
     * @var bool|null
     */
    protected ?bool $canSendOtherMessages;

    /**
     * Optional. Restricted only. True, if user may add web page previews to his messages,
     * implies can_send_media_messages
     *
     * @var bool|null
     */
    protected ?bool $canAddWebPagePreviews;

    /**
     * Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     *
     * @var bool|null
     */
    protected ?bool $canManageTopics;

    /**
     * True, if the user's presence in the chat is hidden
     *
     * @var bool
     */
    protected bool $isAnonymous;

    /**
     * Optional. Custom title for this user
     *
     * @var string|null
     */
    protected ?string $customTitle;

    /**
     * True, if the administrator can access the chat event log, chat statistics, message statistics in channels,
     * see channel members, see anonymous administrators in supergroups and ignore slow mode.
     * Implied by any other administrator privilege
     *
     * @var bool
     */
    protected bool $canManageChat;

    /**
     * True, if the user is allowed to send polls
     *
     * @var bool
     */
    protected bool $canSendPolls;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return void
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getUntilDate(): ?int
    {
        return $this->untilDate;
    }

    /**
     * @param int $untilDate
     * @return void
     */
    public function setUntilDate(int $untilDate): void
    {
        $this->untilDate = $untilDate;
    }

    /**
     * @return bool|null
     */
    public function getCanBeEdited(): ?bool
    {
        return $this->canBeEdited;
    }

    /**
     * @param bool $canBeEdited
     * @return void
     */
    public function setCanBeEdited(bool $canBeEdited): void
    {
        $this->canBeEdited = $canBeEdited;
    }

    /**
     * @return bool|null
     */
    public function getCanChangeInfo(): ?bool
    {
        return $this->canChangeInfo;
    }

    /**
     * @param bool $canChangeInfo
     * @return void
     */
    public function setCanChangeInfo(bool $canChangeInfo): void
    {
        $this->canChangeInfo = $canChangeInfo;
    }

    /**
     * @return bool|null
     */
    public function getCanPostMessages(): ?bool
    {
        return $this->canPostMessages;
    }

    /**
     * @param bool $canPostMessages
     * @return void
     */
    public function setCanPostMessages(bool $canPostMessages): void
    {
        $this->canPostMessages = $canPostMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanEditMessages(): ?bool
    {
        return $this->canEditMessages;
    }

    /**
     * @param bool $canEditMessages
     * @return void
     */
    public function setCanEditMessages(bool $canEditMessages): void
    {
        $this->canEditMessages = $canEditMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanDeleteMessages(): ?bool
    {
        return $this->canDeleteMessages;
    }

    /**
     * @param bool $canDeleteMessages
     * @return void
     */
    public function setCanDeleteMessages(bool $canDeleteMessages): void
    {
        $this->canDeleteMessages = $canDeleteMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanInviteUsers(): ?bool
    {
        return $this->canInviteUsers;
    }

    /**
     * @param bool $canInviteUsers
     * @return void
     */
    public function setCanInviteUsers(bool $canInviteUsers): void
    {
        $this->canInviteUsers = $canInviteUsers;
    }

    /**
     * @return bool|null
     */
    public function getCanRestrictMembers(): ?bool
    {
        return $this->canRestrictMembers;
    }

    /**
     * @param bool $canRestrictMembers
     * @return void
     */
    public function setCanRestrictMembers(bool $canRestrictMembers): void
    {
        $this->canRestrictMembers = $canRestrictMembers;
    }

    /**
     * @return bool|null
     */
    public function getCanPinMessages(): ?bool
    {
        return $this->canPinMessages;
    }

    /**
     * @param bool $canPinMessages
     * @return void
     */
    public function setCanPinMessages(bool $canPinMessages): void
    {
        $this->canPinMessages = $canPinMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanPromoteMembers(): ?bool
    {
        return $this->canPromoteMembers;
    }

    /**
     * @param bool $canPromoteMembers
     * @return void
     */
    public function setCanPromoteMembers(bool $canPromoteMembers): void
    {
        $this->canPromoteMembers = $canPromoteMembers;
    }

    /**
     * @return bool|null
     */
    public function getCanSendMessages(): ?bool
    {
        return $this->canSendMessages;
    }

    /**
     * @param bool $canSendMessages
     * @return void
     */
    public function setCanSendMessages(bool $canSendMessages): void
    {
        $this->canSendMessages = $canSendMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanSendMediaMessages(): ?bool
    {
        return $this->canSendMediaMessages;
    }

    /**
     * @param bool $canSendMediaMessages
     * @return void
     */
    public function setCanSendMediaMessages(bool $canSendMediaMessages): void
    {
        $this->canSendMediaMessages = $canSendMediaMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanSendOtherMessages(): ?bool
    {
        return $this->canSendOtherMessages;
    }

    /**
     * @param bool $canSendOtherMessages
     * @return void
     */
    public function setCanSendOtherMessages(bool $canSendOtherMessages): void
    {
        $this->canSendOtherMessages = $canSendOtherMessages;
    }

    /**
     * @return bool|null
     */
    public function getCanAddWebPagePreviews(): ?bool
    {
        return $this->canAddWebPagePreviews;
    }

    /**
     * @param bool $canAddWebPagePreviews
     * @return void
     */
    public function setCanAddWebPagePreviews(bool $canAddWebPagePreviews): void
    {
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
    }

    /**
     * @return bool
     */
    public function getCanManageChat(): bool
    {
        return $this->canManageChat;
    }

    /**
     * @param bool $canManageChat
     * @return void
     */
    public function setCanManageChat(bool $canManageChat): void
    {
        $this->canManageChat = $canManageChat;
    }

    /**
     * @return bool
     */
    public function getIsAnonymous(): bool
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
     * @return bool
     */
    public function getCanSendPolls(): bool
    {
        return $this->canSendPolls;
    }

    /**
     * @param bool $canSendPolls
     * @return void
     */
    public function setCanSendPolls(bool $canSendPolls): void
    {
        $this->canSendPolls = $canSendPolls;
    }

    /**
     * @return bool|null
     */
    public function getCanManageTopics(): ?bool
    {
        return $this->canManageTopics;
    }

    /**
     * @param bool $canManageTopics
     * @return void
     */
    public function setCanManageTopics(bool $canManageTopics): void
    {
        $this->canManageTopics = $canManageTopics;
    }

    /**
     * @return null|string
     */
    public function getCustomTitle(): ?string
    {
        return $this->customTitle;
    }

    /**
     * @param string $customTitle
     * @return void
     */
    public function setCustomTitle(string $customTitle): void
    {
        $this->customTitle = $customTitle;
    }
}
