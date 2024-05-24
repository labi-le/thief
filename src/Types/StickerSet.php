<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class StickerSet
 * This object represents a sticker set.
 *
 * @author bernard-ng <bernard@devscast.tech>
 */
class StickerSet extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['name', 'title', 'sticker_type', 'is_animated', 'is_video', 'stickers'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'name' => true,
        'title' => true,
        'sticker_type' => true,
        'is_animated' => true,
        'is_video' => true,
        'stickers' => ArrayOfSticker::class,
        'thumbnail' => PhotoSize::class,
    ];

    /**
     * Sticker set name
     *
     * @var string
     */
    protected string $name;

    /**
     * Sticker set title
     *
     * @var string
     */
    protected string $title;

    /**
     * Type of stickers in the set, currently one of “regular”, “mask”, “custom_emoji”
     *
     * @var string
     */
    protected string $stickerType;

    /**
     * True, if the sticker set contains animated stickers
     *
     * @var bool
     */
    protected bool $isAnimated;

    /**
     * True, if the sticker set contains video stickers
     *
     * @var bool
     */
    protected bool $isVideo;

    /**
     * List of all set stickers
     *
     * @var ArrayOfSticker
     */
    protected ArrayOfSticker $stickers;

    /**
     * Optional. Sticker set thumbnail in the .WEBP or .TGS format
     *
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getStickerType(): string
    {
        return $this->stickerType;
    }

    /**
     * @param string $stickerType
     *
     * @return void
     */
    public function setStickerType(string $stickerType): void
    {
        $this->stickerType = $stickerType;
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
     * @return ArrayOfSticker
     */
    public function getStickers(): ArrayOfSticker
    {
        return $this->stickers;
    }

    /**
     * @param ArrayOfSticker $stickers
     *
     * @return void
     */
    public function setStickers(ArrayOfSticker $stickers): void
    {
        $this->stickers = $stickers;
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
}
