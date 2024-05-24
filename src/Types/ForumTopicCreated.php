<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * class ForumTopicCreated.
 * This object represents a service message about a new forum topic created in the chat.
 *
 * @author bernard-ng <bernard@devscast.tech>
 */
class ForumTopicCreated extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['name', 'icon_color'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'name' => true,
        'icon_color' => true,
        'icon_custom_emoji_id' => true,
    ];

    /**
     * Name of the forum topic
     *
     * @var string
     */
    protected string $name;

    /**
     * Color of the forum topic
     *
     * @var string
     */
    protected string $iconColor;

    /**
     * Custom emoji of the forum topic
     *
     * @var string
     */
    protected string $iconCustomEmojiId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIconColor(): string
    {
        return $this->iconColor;
    }

    /**
     * @param string $iconColor
     * @return void
     */
    public function setIconColor(string $iconColor): void
    {
        $this->iconColor = $iconColor;
    }

    /**
     * @return string
     */
    public function getIconCustomEmojiId(): string
    {
        return $this->iconCustomEmojiId;
    }

    /**
     * @param string $iconCustomEmojiId
     * @return void
     */
    public function setIconCustomEmojiId(string $iconCustomEmojiId): void
    {
        $this->iconCustomEmojiId = $iconCustomEmojiId;
    }
}
