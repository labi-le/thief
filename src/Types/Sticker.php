<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class Sticker
 * This object represents a sticker.
 *
 */
class Sticker extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = [
        'file_id',
        'file_unique_id',
        'type',
        'width',
        'height',
        'is_animated',
        'is_video'
    ];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'type' => true,
        'width' => true,
        'height' => true,
        'is_animated' => true,
        'is_video' => true,
        'thumbnail' => PhotoSize::class,
        'file_size' => true,
        'premium_animation' => File::class,
        'emoji' => true,
        'set_name' => true,
        'mask_position' => MaskPosition::class,
        'custom_emoji_id' => true,
    ];

    /**
     * Unique identifier for this file
     *
     * @var string
     */
    protected string $fileId;

    /**
     * Sticker width
     *
     * @var int
     */
    protected int $width;

    /**
     * Sticker height
     *
     * @var int
     */
    protected int $height;

    /**
     * 	Optional. Sticker thumbnail in the .WEBP or .JPG format
     *
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail;

    /**
     * Optional. File size
     *
     * @var int|null
     */
    protected ?int $fileSize;

    /**
     * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”.
     * The type of the sticker is independent from its format,
     * which is determined by the fields is_animated and is_video.
     *
     * @var string
     */
    protected string $type;

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots.
     * Can't be used to download or reuse the file.
     *
     * @var string
     */
    protected string $fileUniqueId;

    /**
     * Optional. For premium regular stickers, premium animation for the sticker
     *
     * @var File|null
     */
    protected ?File $premiumAnimation;

    /**
     * True, if the sticker is animated
     *
     * @var bool
     */
    protected bool $isAnimated;

    /**
     * True, if the sticker is a video sticker
     *
     * @var bool
     */
    protected bool $isVideo;

    /**
     * Optional. Emoji associated with the sticker
     *
     * @var string|null
     */
    protected ?string $emoji;

    /**
     * Optional. Name of the sticker set to which the sticker belongs
     *
     * @var string|null
     */
    protected ?string $setName;

    /**
     * Optional. For mask stickers, the position where the mask should be placed
     *
     * @var MaskPosition|null
     */
    protected ?MaskPosition $maskPosition;

    /**
     * Optional. For custom emoji stickers, unique identifier of the custom emoji
     *
     * @var string|null
     */
    protected ?string $customEmojiId;

    /**
     * @return string
     */
    public function getFileId(): string
    {
        return $this->fileId;
    }

    /**
     * @param string $fileId
     *
     * @return void
     */
    public function setFileId(string $fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return int|null
     */
    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setFileSize(mixed $fileSize): void
    {
        if (is_integer($fileSize)) {
            $this->fileSize = $fileSize;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setHeight(mixed $height): void
    {
        if (is_integer($height)) {
            $this->height = $height;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return PhotoSize|null
     */
    public function getThumbnail(): ?PhotoSize
    {
        return $this->thumbnail;
    }

    /**
     * @param PhotoSize $thumbnail
     *
     * @return void
     */
    public function setThumbnail(PhotoSize $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @deprecated use getThumbnail method
     *
     * @return PhotoSize|null
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->getThumbnail();
    }

    /**
     * @param PhotoSize $thumb
     *
     * @return void
     *@deprecated use setThumbnail method
     *
     */
    public function setThumb(PhotoSize $thumb): void
    {
        $this->setThumbnail($thumb);
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setWidth(mixed $width): void
    {
        if (is_integer($width)) {
            $this->width = $width;
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
     *
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFileUniqueId(): string
    {
        return $this->fileUniqueId;
    }

    /**
     * @param string $fileUniqueId
     *
     * @return void
     */
    public function setFileUniqueId(string $fileUniqueId): void
    {
        $this->fileUniqueId = $fileUniqueId;
    }

    /**
     * @return File|null
     */
    public function getPremiumAnimation(): ?File
    {
        return $this->premiumAnimation;
    }

    /**
     * @param File $premiumAnimation
     *
     * @return void
     */
    public function setPremiumAnimation(File $premiumAnimation): void
    {
        $this->premiumAnimation = $premiumAnimation;
    }

    /**
     * @return bool
     */
    public function getIsAnimated(): bool
    {
        return $this->isAnimated;
    }

    /**
     * @param bool $isAnimated
     *
     * @return void
     */
    public function setIsAnimated(bool $isAnimated): void
    {
        $this->isAnimated = $isAnimated;
    }

    /**
     * @return bool
     */
    public function getIsVideo(): bool
    {
        return $this->isVideo;
    }

    /**
     * @param bool $isVideo
     *
     * @return void
     */
    public function setIsVideo(bool $isVideo): void
    {
        $this->isVideo = $isVideo;
    }

    /**
     * @return null|string
     */
    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    /**
     * @param string $emoji
     *
     * @return void
     */
    public function setEmoji(string $emoji): void
    {
        $this->emoji = $emoji;
    }

    /**
     * @return null|string
     */
    public function getSetName(): ?string
    {
        return $this->setName;
    }

    /**
     * @param string $setName
     *
     * @return void
     */
    public function setSetName(string $setName): void
    {
        $this->setName = $setName;
    }

    /**
     * @return MaskPosition|null
     */
    public function getMaskPosition(): ?MaskPosition
    {
        return $this->maskPosition;
    }

    /**
     * @param MaskPosition $maskPosition
     *
     * @return void
     */
    public function setMaskPosition(MaskPosition $maskPosition): void
    {
        $this->maskPosition = $maskPosition;
    }

    /**
     * @return null|string
     */
    public function getCustomEmojiId(): ?string
    {
        return $this->customEmojiId;
    }

    /**
     * @param string $customEmojiId
     *
     * @return void
     */
    public function setCustomEmojiId(string $customEmojiId): void
    {
        $this->customEmojiId = $customEmojiId;
    }
}
