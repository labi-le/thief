<?php
declare(strict_types=1);

namespace labile\thief\Types;

use labile\thief\Types\Inline\ChosenInlineResult;
use labile\thief\Types\Inline\InlineQuery;
use labile\thief\Types\Payments\Query\PreCheckoutQuery;
use labile\thief\Types\Payments\Query\ShippingQuery;

/**
 * Class Update
 * This object represents an incoming update.
 * Only one of the optional parameters can be present in any given update.
 *
 */
class Update extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['update_id'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'update_id' => true,
        'message' => Message::class,
        'edited_message' => Message::class,
        'channel_post' => Message::class,
        'edited_channel_post' => Message::class,
        'inline_query' => InlineQuery::class,
        'chosen_inline_result' => ChosenInlineResult::class,
        'callback_query' => CallbackQuery::class,
        'shipping_query' => ShippingQuery::class,
        'pre_checkout_query' => PreCheckoutQuery::class,
        'poll_answer' => PollAnswer::class,
        'poll' => Poll::class,
        'my_chat_member' => ChatMemberUpdated::class,
        'chat_member' => ChatMemberUpdated::class,
        'chat_join_request' => ChatJoinRequest::class,
    ];

    /**
     * The update‘s unique identifier.
     * Update identifiers start from a certain positive number and increase sequentially.
     * This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or
     * to restore the correct update sequence, should they get out of order.
     *
     * @var integer
     */
    protected int $updateId;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     *
     * @var Message|null
     */
    protected ?Message $message;

    /**
     * Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     *
     * @var PollAnswer|null
     */
    protected ?PollAnswer $pollAnswer;

    /**
     * Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     *
     * @var Poll|null
     */
    protected ?Poll $poll;

    /**
     * Optional. New version of a message that is known to the bot and was edited
     *
     * @var Message|null
     */
    protected ?Message $editedMessage;

    /**
     * Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     *
     * @var Message|null
     */
    protected ?Message $channelPost;

    /**
     * Optional. New version of a channel post that is known to the bot and was edited
     *
     * @var Message|null
     */
    protected ?Message $editedChannelPost;

    /**
     * Optional. New incoming inline query
     *
     * @var InlineQuery|null
     */
    protected ?InlineQuery $inlineQuery;

    /**
     * Optional. The result of a inline query that was chosen by a user and sent to their chat partner
     *
     * @var ChosenInlineResult|null
     */
    protected ?ChosenInlineResult $chosenInlineResult;

    /**
     * Optional. New incoming callback query
     *
     * @var CallbackQuery|null
     */
    protected ?CallbackQuery $callbackQuery;

    /**
     * Optional. New incoming shipping query. Only for invoices with flexible price
     *
     * @var ShippingQuery|null
     */
    protected ?ShippingQuery $shippingQuery;

    /**
     * Optional. New incoming pre-checkout query. Contains full information about checkout
     *
     * @var PreCheckoutQuery|null
     */
    protected ?PreCheckoutQuery $preCheckoutQuery;

    /**
     * Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only
     * when the bot is blocked or unblocked by the user.
     *
     * @var ChatMemberUpdated|null
     */
    protected ?ChatMemberUpdated $myChatMember;

    /**
     * Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must
     * explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
     *
     * @var ChatMemberUpdated|null
     */
    protected ?ChatMemberUpdated $chatMember;

    /**
     * Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator
     * right in the chat to receive these updates.
     *
     * @var ChatJoinRequest|null
     */
    protected ?ChatJoinRequest $chatJoinRequest;

    /**
     * @return int
     */
    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    /**
     * @param int $updateId
     *
     * @return void
     */
    public function setUpdateId(int $updateId): void
    {
        $this->updateId = $updateId;
    }

    /**
     * @return Message|null
     */
    public function getMessage(): ?Message
    {
        return $this->message;
    }

    /**
     * @param Message $message
     *
     * @return void
     */
    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    /**
     * @return Message|null
     */
    public function getEditedMessage(): ?Message
    {
        return $this->editedMessage;
    }

    /**
     * @param Message $editedMessage
     *
     * @return void
     */
    public function setEditedMessage(Message $editedMessage): void
    {
        $this->editedMessage = $editedMessage;
    }

    /**
     * @return Message|null
     */
    public function getChannelPost(): ?Message
    {
        return $this->channelPost;
    }

    /**
     * @param Message $channelPost
     *
     * @return void
     */
    public function setChannelPost(Message $channelPost): void
    {
        $this->channelPost = $channelPost;
    }

    /**
     * @return PollAnswer|null
     */
    public function getPollAnswer(): ?PollAnswer
    {
        return $this->pollAnswer;
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
     *
     * @return void
     */
    public function setPoll(Poll $poll): void
    {
        $this->poll = $poll;
    }

    /**
     * @param PollAnswer $pollAnswer
     *
     * @return void
     */
    public function setPollAnswer(PollAnswer $pollAnswer): void
    {
        $this->pollAnswer = $pollAnswer;
    }

    /**
     * @return Message|null
     */
    public function getEditedChannelPost(): ?Message
    {
        return $this->editedChannelPost;
    }

    /**
     * @param Message $editedChannelPost
     *
     * @return void
     */
    public function setEditedChannelPost(Message $editedChannelPost): void
    {
        $this->editedChannelPost = $editedChannelPost;
    }

    /**
     * @return InlineQuery|null
     */
    public function getInlineQuery(): ?InlineQuery
    {
        return $this->inlineQuery;
    }

    /**
     * @param InlineQuery $inlineQuery
     *
     * @return void
     */
    public function setInlineQuery(InlineQuery $inlineQuery): void
    {
        $this->inlineQuery = $inlineQuery;
    }

    /**
     * @return ChosenInlineResult|null
     */
    public function getChosenInlineResult(): ?ChosenInlineResult
    {
        return $this->chosenInlineResult;
    }

    /**
     * @param ChosenInlineResult $chosenInlineResult
     *
     * @return void
     */
    public function setChosenInlineResult(ChosenInlineResult $chosenInlineResult): void
    {
        $this->chosenInlineResult = $chosenInlineResult;
    }

    /**
     * @return CallbackQuery|null
     */
    public function getCallbackQuery(): ?CallbackQuery
    {
        return $this->callbackQuery;
    }

    /**
     * @param CallbackQuery $callbackQuery
     *
     * @return void
     */
    public function setCallbackQuery(CallbackQuery $callbackQuery): void
    {
        $this->callbackQuery = $callbackQuery;
    }

    /**
     * @author MY
     *
     * @return ShippingQuery|null
     */
    public function getShippingQuery(): ?ShippingQuery
    {
        return $this->shippingQuery;
    }

    /**
     * @param ShippingQuery $shippingQuery
          *
          * @return void
     *@author MY
     *
     */
    public function setShippingQuery(ShippingQuery $shippingQuery): void
    {
        $this->shippingQuery = $shippingQuery;
    }

    /**
     * @author MY
     *
     * @return PreCheckoutQuery|null
     */
    public function getPreCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->preCheckoutQuery;
    }

    /**
     * @param PreCheckoutQuery $preCheckoutQuery
          *
     * @return void
     *@author MY
     *
     */
    public function setPreCheckoutQuery(PreCheckoutQuery $preCheckoutQuery): void
    {
        $this->preCheckoutQuery = $preCheckoutQuery;
    }

    /**
     * @return ChatMemberUpdated|null
     */
    public function getMyChatMember(): ?ChatMemberUpdated
    {
        return $this->myChatMember;
    }

    /**
     * @param ChatMemberUpdated|null $myChatMember
     * @return void
     */
    public function setMyChatMember(?ChatMemberUpdated $myChatMember): void
    {
        $this->myChatMember = $myChatMember;
    }

    /**
     * @return ChatMemberUpdated|null
     */
    public function getChatMember(): ?ChatMemberUpdated
    {
        return $this->chatMember;
    }

    /**
     * @param ChatMemberUpdated|null $chatMember
     * @return void
     */
    public function setChatMember(?ChatMemberUpdated $chatMember): void
    {
        $this->chatMember = $chatMember;
    }

    /**
     * @return ChatJoinRequest|null
     */
    public function getChatJoinRequest(): ?ChatJoinRequest
    {
        return $this->chatJoinRequest;
    }

    /**
     * @param ChatJoinRequest|null $chatJoinRequest
     * @return void
     */
    public function setChatJoinRequest(?ChatJoinRequest $chatJoinRequest): void
    {
        $this->chatJoinRequest = $chatJoinRequest;
    }
}
