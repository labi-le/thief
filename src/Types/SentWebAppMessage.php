<?php
declare(strict_types=1);

namespace labile\thief\Types;


class SentWebAppMessage extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = [];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'inline_message_id' => true,
    ];

    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
     *
     * @var string|null
     */
    protected ?string $inlineMessageId;

    /**
     * @return string|null
     */
    public function getInlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }

    /**
     * @param string|null $inlineMessageId
     * @return void
     */
    public function setInlineMessageId(?string $inlineMessageId): void
    {
        $this->inlineMessageId = $inlineMessageId;
    }
}
