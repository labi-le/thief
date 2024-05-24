<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * This object represents a unique message identifier.
 */
class MessageId extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['message_id'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'message_id' => true,
    ];

    /**
     * Unique message identifier
     *
     * @var integer
     */
    protected int $messageId;

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     * @return void
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }
}
