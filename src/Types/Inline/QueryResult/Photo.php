<?php
declare(strict_types=1);

namespace labile\thief\Types\Inline\QueryResult;

use labile\thief\Types\Inline\InlineKeyboardMarkup;
use labile\thief\Types\Inline\InputMessageContent;

/**
 * Class InlineQueryResultPhoto
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption.
 * Alternatively, you can provide message_text to send it instead of photo.
 *
 */
class Photo extends AbstractInlineQueryResult
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['type', 'id', 'photo_url', 'thumbnail_url'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'type' => true,
        'id' => true,
        'photo_url' => true,
        'thumbnail_url' => true,
        'photo_width' => true,
        'photo_height' => true,
        'title' => true,
        'description' => true,
        'caption' => true,
        'input_message_content' => InputMessageContent::class,
        'reply_markup' => InlineKeyboardMarkup::class,
    ];

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected string $type = 'photo';

    /**
     * A valid URL of the photo. Photo size must not exceed 5MB
     *
     * @var string
     */
    protected string $photoUrl;

    /**
     * Optional. Width of the photo
     *
     * @var int|null
     */
    protected ?int $photoWidth;

    /**
     * Optional. Height of the photo
     *
     * @var int|null
     */
    protected ?int $photoHeight;

    /**
     * URL of the thumbnail for the photo
     *
     * @var string
     */
    protected string $thumbnailUrl;

    /**
     * Optional. Short description of the result
     *
     * @var string|null
     */
    protected ?string $description;

    /**
     * Optional. Caption of the photo to be sent, 0-200 characters
     *
     * @var string|null
     */
    protected ?string $caption;

    /**
     * InlineQueryResultPhoto constructor.
     *
     * @param string $id
     * @param string $photoUrl
     * @param string $thumbnailUrl
     * @param int|null $photoWidth
     * @param int|null $photoHeight
     * @param string|null $title
     * @param string|null $description
     * @param string|null $caption
     * @param InputMessageContent|null $inputMessageContent
     * @param InlineKeyboardMarkup|null $inlineKeyboardMarkup
     */
    public function __construct(
        string               $id,
        string               $photoUrl,
                             $thumbnailUrl,
                             $photoWidth = null,
        int                  $photoHeight = null,
        string               $title = null,
        string               $description = null,
        string               $caption = null,
        InputMessageContent  $inputMessageContent = null,
        InlineKeyboardMarkup $inlineKeyboardMarkup = null
    ) {
        parent::__construct($id, $title, $inputMessageContent, $inlineKeyboardMarkup);

        $this->photoUrl = $photoUrl;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->photoWidth = $photoWidth;
        $this->photoHeight = $photoHeight;
        $this->description = $description;
        $this->caption = $caption;
    }

    /**
     * @return string
     */
    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }

    /**
     * @param string $photoUrl
     *
     * @return void
     */
    public function setPhotoUrl(string $photoUrl): void
    {
        $this->photoUrl = $photoUrl;
    }

    /**
     * @return int|null
     */
    public function getPhotoWidth(): ?int
    {
        return $this->photoWidth;
    }

    /**
     * @param int|null $photoWidth
     *
     * @return void
     */
    public function setPhotoWidth(?int $photoWidth): void
    {
        $this->photoWidth = $photoWidth;
    }

    /**
     * @return int|null
     */
    public function getPhotoHeight(): ?int
    {
        return $this->photoHeight;
    }

    /**
     * @param int|null $photoHeight
     *
     * @return void
     */
    public function setPhotoHeight(?int $photoHeight): void
    {
        $this->photoHeight = $photoHeight;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     *
     * @return void
     */
    public function setThumbnailUrl(string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @deprecated Use getThumbnailUrl
     *
     * @return string
     */
    public function getThumbUrl(): string
    {
        return $this->getThumbnailUrl();
    }

    /**
     * @param string $thumbUrl
     *
     * @return void
     *@deprecated Use setThumbnailUrl
     *
     */
    public function setThumbUrl(string $thumbUrl): void
    {
        $this->setThumbnailUrl($thumbUrl);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string|null $caption
     *
     * @return void
     */
    public function setCaption(?string $caption): void
    {
        $this->caption = $caption;
    }
}
