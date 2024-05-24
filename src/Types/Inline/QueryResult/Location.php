<?php
declare(strict_types=1);


namespace labile\thief\Types\Inline\QueryResult;

use labile\thief\Types\Inline\InlineKeyboardMarkup;
use labile\thief\Types\Inline\InputMessageContent;

/**
 * Class Location
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultlocation
 * Represents a location on a map. By default, the location will be sent by the user.
 * Alternatively, you can use InputMessageContent to send a message with the specified content instead of the location.
 *
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 *
 */
class Location extends AbstractInlineQueryResult
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['type', 'id', 'latitude', 'longitude', 'title'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'type' => true,
        'id' => true,
        'latitude' => true,
        'longitude' => true,
        'title' => true,
        'thumbnail_url' => true,
        'thumbnail_width' => true,
        'thumbnail_height' => true,
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected string $type = 'location';

    /**
     * Location latitude in degrees
     *
     * @var float
     */
    protected float $latitude;

    /**
     * Location longitude in degrees
     *
     * @var float
     */
    protected float $longitude;

    /**
     * Optional. Url of the thumbnail for the result
     *
     * @var string|null
     */
    protected ?string $thumbnailUrl;

    /**
     * Optional. Thumbnail width
     *
     * @var int|null
     */
    protected ?int $thumbnailWidth;

    /**
     * Optional. Thumbnail height
     *
     * @var int|null
     */
    protected ?int $thumbnailHeight;

    /**
     * Voice constructor
     *
     * @param string $id
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string|null $thumbnailUrl
     * @param int|null $thumbnailWidth
     * @param int|null $thumbnailHeight
     * @param InlineKeyboardMarkup|null $inlineKeyboardMarkup
     * @param InputMessageContent|null $inputMessageContent
     */
    public function __construct(
        string               $id,
                             $latitude,
                             $longitude,
                             $title,
        string               $thumbnailUrl = null,
        int                  $thumbnailWidth = null,
        int                  $thumbnailHeight = null,
        InlineKeyboardMarkup $inlineKeyboardMarkup = null,
        InputMessageContent  $inputMessageContent = null
    ) {
        parent::__construct($id, $title, $inputMessageContent, $inlineKeyboardMarkup);

        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return void
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return void
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string|null
     */
    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string|null $thumbnailUrl
     *
     * @return void
     */
    public function setThumbnailUrl(?string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @deprecated Use getThumbnailUrl
     *
     * @return string|null
     */
    public function getThumbUrl(): ?string
    {
        return $this->getThumbnailUrl();
    }

    /**
     * @param string|null $thumbUrl
     *
     * @return void
          *@deprecated Use setThumbnailUrl
     *
     */
    public function setThumbUrl(?string $thumbUrl): void
    {
        $this->setThumbnailUrl($thumbUrl);
    }

    /**
     * @return int|null
     */
    public function getThumbnailWidth(): ?int
    {
        return $this->thumbnailWidth;
    }

    /**
     * @param int|null $thumbnailWidth
     *
     * @return void
     */
    public function setThumbnailWidth(?int $thumbnailWidth): void
    {
        $this->thumbnailWidth = $thumbnailWidth;
    }

    /**
     * @deprecated Use getThumbnailWidth
     *
     * @return int|null
     */
    public function getThumbWidth(): ?int
    {
        return $this->getThumbnailWidth();
    }

    /**
     * @param int|null $thumbWidth
     *
     * @return void
     *@deprecated Use setThumbnailWidth
     *
     */
    public function setThumbWidth(?int $thumbWidth): void
    {
        $this->setThumbnailWidth($thumbWidth);
    }

    /**
     * @return int|null
     */
    public function getThumbnailHeight(): ?int
    {
        return $this->thumbnailHeight;
    }

    /**
     * @param int|null $thumbnailHeight
     *
     * @return void
     */
    public function setThumbnailHeight(?int $thumbnailHeight): void
    {
        $this->thumbnailHeight = $thumbnailHeight;
    }

    /**
     * @deprecated Use getThumbnailHeight
     *
     * @return int|null
     */
    public function getThumbHeight(): ?int
    {
        return $this->getThumbnailHeight();
    }

    /**
     * @param int|null $thumbHeight
     *
     * @return void
     *@deprecated Use setThumbnailWidth
     *
     */
    public function setThumbHeight(?int $thumbHeight): void
    {
        $this->setThumbnailHeight($thumbHeight);
    }
}
