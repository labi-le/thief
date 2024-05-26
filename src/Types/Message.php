<?php
declare(strict_types=1);

namespace labile\thief\Types;

use InvalidArgumentException;
use labile\thief\Types\Inline\InlineKeyboardMarkup;
use labile\thief\Types\Payments\Invoice;
use labile\thief\Types\Payments\SuccessfulPayment;

class Message extends BaseType implements TypeInterface, Event
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['message_id', 'date', 'chat'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'message_id' => true,
        'from' => User::class,
        'date' => true,
        'chat' => Chat::class,
        'forward_from' => User::class,
        'forward_from_chat' => Chat::class,
        'forward_from_message_id' => true,
        'forward_date' => true,
        'forward_signature' => true,
        'forward_sender_name' => true,
        'reply_to_message' => Message::class,
        'via_bot' => User::class,
        'edit_date' => true,
        'media_group_id' => true,
        'author_signature' => true,
        'text' => true,
        'entities' => ArrayOfMessageEntity::class,
        'caption_entities' => ArrayOfMessageEntity::class,
        'audio' => Audio::class,
        'document' => Document::class,
        'animation' => Animation::class,
        'photo' => ArrayOfPhotoSize::class,
        'sticker' => Sticker::class,
        'video' => Video::class,
        'video_note' => VideoNote::class,
        'voice' => Voice::class,
        'caption' => true,
        'contact' => Contact::class,
        'location' => Location::class,
        'venue' => Venue::class,
        'poll' => Poll::class,
        'dice' => Dice::class,
        'new_chat_members' => ArrayOfUser::class,
        'left_chat_member' => User::class,
        'new_chat_title' => true,
        'new_chat_photo' => ArrayOfPhotoSize::class,
        'delete_chat_photo' => true,
        'group_chat_created' => true,
        'supergroup_chat_created' => true,
        'channel_chat_created' => true,
        'migrate_to_chat_id' => true,
        'migrate_from_chat_id' => true,
        'pinned_message' => Message::class,
        'invoice' => Invoice::class,
        'successful_payment' => SuccessfulPayment::class,
        'connected_website' => true,
        'forum_topic_created' => ForumTopicCreated::class,
        'forum_topic_closed' => ForumTopicClosed::class,
        'forum_topic_reopened' => ForumTopicReopened::class,
        'is_topic_message' => true,
        'message_thread_id' => true,
        'web_app_data' => WebAppData::class,
        'reply_markup' => InlineKeyboardMarkup::class,
    ];

    /**
     * Unique message identifier
     *
     * @var int|float
     */
    protected int|float $messageId;

    /**
     * Optional. Sender name. Can be empty for messages sent to channels
     *
     * @var User|null
     */
    protected ?User $from;

    /**
     * Date the message was sent in Unix time
     *
     * @var int
     */
    protected int $date;

    /**
     * Conversation the message belongs to — user in case of a private message, GroupChat in case of a group
     *
     * @var Chat
     */
    protected Chat $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     *
     * @var User|null
     */
    protected ?User $forwardFrom;

    /**
     * Optional. For messages forwarded from channels, information about
     * the original channel
     *
     * @var Chat|null
     */
    protected ?Chat $forwardFromChat;

    /**
     * Optional. For messages forwarded from channels, identifier of
     * the original message in the channel
     *
     * @var int|null
     */
    protected ?int $forwardFromMessageId;

    /**
     * Optional. For messages forwarded from channels, signature of the post author if present
     *
     * @var string|null
     */
    protected ?string $forwardSignature;

    /**
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account
     * in forwarded messages
     *
     * @var string|null
     */
    protected ?string $forwardSenderName;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     *
     * @var int|null
     */
    protected ?int $forwardDate;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it itself is a reply.
     *
     * @var Message|null
     */
    protected ?Message $replyToMessage;

    /**
     * Optional. Bot through which the message was sent.
     *
     * @var User|null
     */
    protected ?User $viaBot;

    /**
     * Optional. Date the message was last edited in Unix time
     *
     * @var int|null
     */
    protected ?int $editDate;

    /**
     * Optional. The unique identifier of a media message group
     * this message belongs to
     *
     * @var int|null
     */
    protected ?int $mediaGroupId;

    /**
     * Optional. Signature of the post author for messages in channels
     *
     * @var string|null
     */
    protected ?string $authorSignature;

    /**
     * Optional. For text messages, the actual UTF-8 text of the message
     *
     * @var string|null
     */
    protected ?string $text;

    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text.
     * array of \TelegramBot\Api\Types\MessageEntity
     *
     * @var array|null
     */
    protected ?array $entities;

    /**
     * Optional. For messages with a caption, special entities like usernames,
     * URLs, bot commands, etc. that appear in the caption
     *
     * @var ArrayOfMessageEntity|null
     */
    protected ?ArrayOfMessageEntity $captionEntities;

    /**
     * Optional. Message is an audio file, information about the file
     *
     * @var Audio|null
     */
    protected ?Audio $audio;

    /**
     * Optional. Message is a general file, information about the file
     *
     * @var Document|null
     */
    protected ?Document $document;

    /**
     * Optional. Message is a animation, information about the animation
     *
     * @var Animation|null
     */
    protected ?Animation $animation;

    /**
     * Optional. Message is a photo, available sizes of the photo
     * array of \TelegramBot\Api\Types\Photo
     *
     * @var array|null
     */
    protected ?array $photo;

    /**
     * Optional. Message is a sticker, information about the sticker
     *
     * @var Sticker|null
     */
    protected ?Sticker $sticker;

    /**
     * Optional. Message is a video, information about the video
     *
     * @var Video|null
     */
    protected ?Video $video;

    /**
     * Optional. Message is a video note, information about the video message
     *
     * @var VideoNote|null
     */
    protected ?VideoNote $videoNote;

    /**
     * Optional. Message is a voice message, information about the file
     *
     * @var Voice|null
     */
    protected ?Voice $voice;

    /**
     * Optional. Text description of the video (usually empty)
     *
     * @var string|null
     */
    protected ?string $caption;

    /**
     * Optional. Message is a shared contact, information about the contact
     *
     * @var Contact|null
     */
    protected ?Contact $contact;

    /**
     * Optional. Message is a shared location, information about the location
     *
     * @var Location|null
     */
    protected ?Location $location;

    /**
     * Optional. Message is a venue, information about the venue
     *
     * @var Venue|null
     */
    protected ?Venue $venue;

    /**
     * Optional. Message is a native poll, information about the poll
     *
     * @var Poll|null
     */
    protected ?Poll $poll;

    /**
     * Optional. Message is a dice with random value from 1 to 6
     *
     * @var Dice|null
     */
    protected ?Dice $dice;

    /**
     * Optional. New members that were added to the group or supergroup and information about them
     * (the bot itself may be one of these members)
     * array of \TelegramBot\Api\Types\User
     *
     * @var User[]|null
     */
    protected ?array $newChatMembers;

    /**
     * Optional. A member was removed from the group, information about them (this member may be bot itself)
     *
     * @var User|null
     */
    protected ?User $leftChatMember;

    /**
     * Optional. A group title was changed to this value
     *
     * @var string|null
     */
    protected ?string $newChatTitle;

    /**
     * Optional. A group photo was change to this value
     *
     * @var PhotoSize[]|null
     */
    protected ?array $newChatPhoto;

    /**
     * Optional. Informs that the group photo was deleted
     *
     * @var bool|null
     */
    protected ?bool $deleteChatPhoto;

    /**
     * Optional. Informs that the group has been created
     *
     * @var bool|null
     */
    protected ?bool $groupChatCreated;

    /**
     * Optional. Service message: the supergroup has been created
     *
     * @var bool|null
     */
    protected ?bool $supergroupChatCreated;

    /**
     * Optional. Service message: the channel has been created
     *
     * @var bool|null
     */
    protected ?bool $channelChatCreated;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier,
     * not exceeding 1e13 by absolute value
     *
     * @var int|null
     */
    protected ?int $migrateToChatId;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier,
     * not exceeding 1e13 by absolute value
     *
     * @var int|null
     */
    protected ?int $migrateFromChatId;

    /**
     * Optional. Specified message was pinned.Note that the Message object in this field
     * will not contain further reply_to_message fields even if it is itself a reply.
     *
     * @var Message|null
     */
    protected ?Message $pinnedMessage;

    /**
     * Optional. Message is an invoice for a payment, information about the invoice.
     *
     * @var Invoice|null
     */
    protected ?Invoice $invoice;

    /**
     * Optional. Message is a service message about a successful payment, information about the payment.
     *
     * @var SuccessfulPayment|null
     */
    protected ?SuccessfulPayment $successfulPayment;

    /**
     * Optional. The domain name of the website on which the user has logged in.
     *
     * @var string|null
     */
    protected ?string $connectedWebsite;

    /**
     * Optional. Service message: data sent by a Web App
     *
     * @var WebAppData|null
     */
    protected ?WebAppData $webAppData;

    /**
     * Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     *
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup;

    /**
     * Optional. Service message: forum topic created
     *
     * @var ForumTopicCreated|null
     */
    protected ?ForumTopicCreated $forumTopicCreated;

    /**
     * Optional. Service message: forum topic closed
     *
     * @var ForumTopicReopened|null
     */
    protected ?ForumTopicReopened $forumTopicReopened;

    /**
     * Optional. Service message: forum topic reopened
     *
     * @var ForumTopicClosed|null
     */
    protected ?ForumTopicClosed $forumTopicClosed;

    /**
     * Optional. True, if the message is sent to a forum topic
     *
     * @var bool|null
     */
    protected ?bool $isTopicMessage;

    /**
     * Optional. Unique identifier of a message thread to which the message belongs; for supergroups only
     *
     * @var int|null
     */
    protected ?int $messageThreadId;

    /**
     * @return int|float
     */
    public function getMessageId(): float|int
    {
        return $this->messageId;
    }

    /**
     * @param mixed $messageId
     * @return void
     * @throws InvalidArgumentException
     */
    public function setMessageId(mixed $messageId): void
    {
        if (is_integer($messageId) || is_float($messageId)) {
            $this->messageId = $messageId;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return User|null
     */
    public function getFrom(): ?User
    {
        return $this->from;
    }

    /**
     * @param User $from
     * @return void
     */
    public function setFrom(User $from): void
    {
        $this->from = $from;
    }

    /**
     * @return Chat
     */
    public function getChat(): Chat
    {
        return $this->chat;
    }

    /**
     * @param Chat $chat
     * @return void
     */
    public function setChat(Chat $chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return void
     * @throws InvalidArgumentException
     */
    public function setDate(mixed $date): void
    {
        if (is_int($date)) {
            $this->date = $date;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return User|null
     */
    public function getForwardFrom(): ?User
    {
        return $this->forwardFrom;
    }

    /**
     * @param User $forwardFrom
     * @return void
     */
    public function setForwardFrom(User $forwardFrom): void
    {
        $this->forwardFrom = $forwardFrom;
    }

    /**
     * @return Chat|null
     */
    public function getForwardFromChat(): ?Chat
    {
        return $this->forwardFromChat;
    }

    /**
     * @param Chat $forwardFromChat
     * @return void
     */
    public function setForwardFromChat(Chat $forwardFromChat): void
    {
        $this->forwardFromChat = $forwardFromChat;
    }

    /**
     * @return int|null
     */
    public function getForwardFromMessageId(): ?int
    {
        return $this->forwardFromMessageId;
    }

    /**
     * @param int $forwardFromMessageId
     * @return void
     */
    public function setForwardFromMessageId(int $forwardFromMessageId): void
    {
        $this->forwardFromMessageId = $forwardFromMessageId;
    }

    /**
     * @return null|string
     */
    public function getForwardSignature(): ?string
    {
        return $this->forwardSignature;
    }

    /**
     * @param string $forwardSignature
     * @return void
     */
    public function setForwardSignature(string $forwardSignature): void
    {
        $this->forwardSignature = $forwardSignature;
    }

    /**
     * @return null|string
     */
    public function getForwardSenderName(): ?string
    {
        return $this->forwardSenderName;
    }

    /**
     * @param string $forwardSenderName
     * @return void
     */
    public function setForwardSenderName(string $forwardSenderName): void
    {
        $this->forwardSenderName = $forwardSenderName;
    }

    /**
     * @return int|null
     */
    public function getForwardDate(): ?int
    {
        return $this->forwardDate;
    }

    /**
     * @param mixed $forwardDate
     * @return void
     * @throws InvalidArgumentException
     */
    public function setForwardDate(mixed $forwardDate): void
    {
        if (is_int($forwardDate)) {
            $this->forwardDate = $forwardDate;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return null|self
     */
    public function getReplyToMessage(): ?Message
    {
        return $this->replyToMessage;
    }

    /**
     * @param Message $replyToMessage
     * @return void
     */
    public function setReplyToMessage(Message $replyToMessage): void
    {
        $this->replyToMessage = $replyToMessage;
    }

    /**
     * @return User|null
     */
    public function getViaBot(): ?User
    {
        return $this->viaBot;
    }

    /**
     * @param User $viaBot
     * @return void
     */
    public function setViaBot(User $viaBot): void
    {
        $this->viaBot = $viaBot;
    }

    /**
     * @return int|null
     */
    public function getEditDate(): ?int
    {
        return $this->editDate;
    }

    /**
     * @param mixed $editDate
     * @return void
     * @throws InvalidArgumentException
     */
    public function setEditDate(mixed $editDate): void
    {
        if (is_int($editDate)) {
            $this->editDate = $editDate;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return int|null
     */
    public function getMediaGroupId(): ?int
    {
        return $this->mediaGroupId;
    }

    /**
     * @param int $mediaGroupId
     * @return void
     */
    public function setMediaGroupId(int $mediaGroupId): void
    {
        $this->mediaGroupId = $mediaGroupId;
    }

    /**
     * @return null|string
     */
    public function getAuthorSignature(): ?string
    {
        return $this->authorSignature;
    }

    /**
     * @param string $authorSignature
     * @return void
     */
    public function setAuthorSignature(string $authorSignature): void
    {
        $this->authorSignature = $authorSignature;
    }

    /**
     * @return null|string
     */
    public function getText(): ?string
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
     * @return array|null
     */
    public function getEntities(): ?array
    {
        return $this->entities;
    }

    /**
     * @param array $entities
     * @return void
     */
    public function setEntities(array $entities): void
    {
        $this->entities = $entities;
    }

    /**
     * @return ArrayOfMessageEntity|null
     */
    public function getCaptionEntities(): ?ArrayOfMessageEntity
    {
        return $this->captionEntities;
    }

    /**
     * @param ArrayOfMessageEntity $captionEntities
     * @return void
     */
    public function setCaptionEntities(ArrayOfMessageEntity $captionEntities): void
    {
        $this->captionEntities = $captionEntities;
    }

    /**
     * @return Audio|null
     */
    public function getAudio(): ?Audio
    {
        return $this->audio;
    }

    /**
     * @param Audio $audio
     * @return void
     */
    public function setAudio(Audio $audio): void
    {
        $this->audio = $audio;
    }

    /**
     * @return Document|null
     */
    public function getDocument(): ?Document
    {
        return $this->document;
    }

    /**
     * @param Document $document
     * @return void
     */
    public function setDocument(Document $document): void
    {
        $this->document = $document;
    }

    /**
     * @return Animation|null
     */
    public function getAnimation(): ?Animation
    {
        return $this->animation;
    }

    /**
     * @param Animation $animation
     * @return void
     */
    public function setAnimation(Animation $animation): void
    {
        $this->animation = $animation;
    }

    /**
     * @return array|null
     */
    public function getPhoto(): ?array
    {
        return $this->photo;
    }

    /**
     * @param array $photo
     * @return void
     */
    public function setPhoto(array $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return Sticker|null
     */
    public function getSticker(): ?Sticker
    {
        return $this->sticker;
    }

    /**
     * @param Sticker $sticker
     * @return void
     */
    public function setSticker(Sticker $sticker): void
    {
        $this->sticker = $sticker;
    }

    /**
     * @return Video|null
     */
    public function getVideo(): ?Video
    {
        return $this->video;
    }

    /**
     * @return VideoNote|null
     */
    public function getVideoNote(): ?VideoNote
    {
        return $this->videoNote;
    }

    /**
     * @param VideoNote|null $videoNote
     * @return void
     */
    public function setVideoNote(?VideoNote $videoNote): void
    {
        $this->videoNote = $videoNote;
    }

    /**
     * @param Video $video
     * @return void
     */
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }

    /**
     * @return Voice|null
     */
    public function getVoice(): ?Voice
    {
        return $this->voice;
    }

    /**
     * @param Voice $voice
     * @return void
     */
    public function setVoice(Voice $voice): void
    {
        $this->voice = $voice;
    }

    /**
     * @return null|string
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return void
     */
    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return Contact|null
     */
    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return void
     */
    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return void
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return Venue|null
     */
    public function getVenue(): ?Venue
    {
        return $this->venue;
    }

    /**
     * @param Venue $venue
     * @return void
     */
    public function setVenue(Venue $venue): void
    {
        $this->venue = $venue;
    }

    /**
     * @return Poll|null
     */
    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    /**
     * @param Poll $poll
     * @return void
     */
    public function setPoll(Poll $poll): void
    {
        $this->poll = $poll;
    }

    /**
     * @return Dice|null
     */
    public function getDice(): ?Dice
    {
        return $this->dice;
    }

    /**
     * @param Dice $dice
     * @return void
     */
    public function setDice(Dice $dice): void
    {
        $this->dice = $dice;
    }

    /**
     * @return User[]|null
     */
    public function getNewChatMembers(): ?array
    {
        return $this->newChatMembers;
    }

    /**
     * @param User[]|null $newChatMembers
     * @return void
     */
    public function setNewChatMembers(?array $newChatMembers): void
    {
        $this->newChatMembers = $newChatMembers;
    }

    /**
     * @return User|null
     */
    public function getLeftChatMember(): ?User
    {
        return $this->leftChatMember;
    }

    /**
     * @param User $leftChatMember
     * @return void
     */
    public function setLeftChatMember(User $leftChatMember): void
    {
        $this->leftChatMember = $leftChatMember;
    }

    /**
     * @return null|string
     */
    public function getNewChatTitle(): ?string
    {
        return $this->newChatTitle;
    }

    /**
     * @param string $newChatTitle
     * @return void
     */
    public function setNewChatTitle(string $newChatTitle): void
    {
        $this->newChatTitle = $newChatTitle;
    }

    /**
     * @return PhotoSize[]|null
     */
    public function getNewChatPhoto(): ?array
    {
        return $this->newChatPhoto;
    }

    /**
     * @param PhotoSize[]|null $newChatPhoto
     * @return void
     */
    public function setNewChatPhoto(?array $newChatPhoto): void
    {
        $this->newChatPhoto = $newChatPhoto;
    }

    /**
     * @return bool|null
     */
    public function isDeleteChatPhoto(): ?bool
    {
        return $this->deleteChatPhoto;
    }

    /**
     * @param mixed $deleteChatPhoto
     * @return void
     */
    public function setDeleteChatPhoto(mixed $deleteChatPhoto): void
    {
        $this->deleteChatPhoto = (bool) $deleteChatPhoto;
    }

    /**
     * @return bool|null
     */
    public function isGroupChatCreated(): ?bool
    {
        return $this->groupChatCreated;
    }

    /**
     * @param mixed $groupChatCreated
     * @return void
     */
    public function setGroupChatCreated(mixed $groupChatCreated): void
    {
        $this->groupChatCreated = (bool) $groupChatCreated;
    }

    /**
     * @return bool|null
     */
    public function isSupergroupChatCreated(): ?bool
    {
        return $this->supergroupChatCreated;
    }

    /**
     * @param bool $supergroupChatCreated
     * @return void
     */
    public function setSupergroupChatCreated(bool $supergroupChatCreated): void
    {
        $this->supergroupChatCreated = $supergroupChatCreated;
    }

    /**
     * @return bool|null
     */
    public function isChannelChatCreated(): ?bool
    {
        return $this->channelChatCreated;
    }

    /**
     * @param bool $channelChatCreated
     * @return void
     */
    public function setChannelChatCreated(bool $channelChatCreated): void
    {
        $this->channelChatCreated = $channelChatCreated;
    }

    /**
     * @return int|null
     */
    public function getMigrateToChatId(): ?int
    {
        return $this->migrateToChatId;
    }

    /**
     * @param int $migrateToChatId
     * @return void
     */
    public function setMigrateToChatId(int $migrateToChatId): void
    {
        $this->migrateToChatId = $migrateToChatId;
    }

    /**
     * @return int|null
     */
    public function getMigrateFromChatId(): ?int
    {
        return $this->migrateFromChatId;
    }

    /**
     * @param int $migrateFromChatId
     * @return void
     */
    public function setMigrateFromChatId(int $migrateFromChatId): void
    {
        $this->migrateFromChatId = $migrateFromChatId;
    }

    /**
     * @return null|self
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
     * @author MY
     *
     * @return Invoice|null
     */
    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     * @return void
     *@author MY
     */
    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @author MY
     *
     * @return SuccessfulPayment|null
     */
    public function getSuccessfulPayment(): ?SuccessfulPayment
    {
        return $this->successfulPayment;
    }

    /**
     * @param SuccessfulPayment $successfulPayment
     * @return void
     *@author MY
     */
    public function setSuccessfulPayment(SuccessfulPayment $successfulPayment): void
    {
        $this->successfulPayment = $successfulPayment;
    }

    /**
     * @return null|string
     */
    public function getConnectedWebsite(): ?string
    {
        return $this->connectedWebsite;
    }

    /**
     * @param string $connectedWebsite
     * @return void
     */
    public function setConnectedWebsite(string $connectedWebsite): void
    {
        $this->connectedWebsite = $connectedWebsite;
    }

    /**
     * @return WebAppData|null
     */
    public function getWebAppData(): ?WebAppData
    {
        return $this->webAppData;
    }

    /**
     * @param WebAppData|null $webAppData
     * @return void
     */
    public function setWebAppData(?WebAppData $webAppData): void
    {
        $this->webAppData = $webAppData;
    }

    /**
     * @return InlineKeyboardMarkup|null
     */
    public function getReplyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->replyMarkup;
    }

    /**
     * @param InlineKeyboardMarkup $replyMarkup
     * @return void
     */
    public function setReplyMarkup(InlineKeyboardMarkup $replyMarkup): void
    {
        $this->replyMarkup = $replyMarkup;
    }

    /**
     * @return ForumTopicCreated|null
     */
    public function getForumTopicCreated(): ?ForumTopicCreated
    {
        return $this->forumTopicCreated;
    }

    /**
     * @param ForumTopicCreated $forumTopicCreated
     * @return void
     */
    public function setForumTopicCreated(ForumTopicCreated $forumTopicCreated): void
    {
        $this->forumTopicCreated = $forumTopicCreated;
    }

    /**
     * @return ForumTopicClosed|null
     */
    public function getForumTopicClosed(): ?ForumTopicClosed
    {
        return $this->forumTopicClosed;
    }

    /**
     * @param ForumTopicClosed $forumTopicClosed
     * @return void
     */
    public function setForumTopicClosed(ForumTopicClosed $forumTopicClosed): void
    {
        $this->forumTopicClosed = $forumTopicClosed;
    }

    /**
     * @return ForumTopicReopened|null
     */
    public function getForumTopicReopened(): ?ForumTopicReopened
    {
        return $this->forumTopicReopened;
    }

    /**
     * @param ForumTopicReopened $forumTopicReopened
     * @return void
     */
    public function setForumTopicReopened(ForumTopicReopened $forumTopicReopened): void
    {
        $this->forumTopicReopened = $forumTopicReopened;
    }

    /**
     * @return bool|null
     */
    public function getIsTopicMessage(): ?bool
    {
        return $this->isTopicMessage;
    }

    /**
     * @param bool $isTopicMessage
     * @return void
     */
    public function setIsTopicMessage(bool $isTopicMessage): void
    {
        $this->isTopicMessage = $isTopicMessage;
    }

    /**
     * @return int|null
     */
    public function getMessageThreadId(): ?int
    {
        return $this->messageThreadId;
    }

    /**
     * @param int|null $messageThreadId
     * @return void
     */
    public function setMessageThreadId(?int $messageThreadId): void
    {
        $this->messageThreadId = $messageThreadId;
    }
}
