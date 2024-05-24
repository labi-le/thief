<?php
declare(strict_types=1);

namespace labile\thief\Types\Inline\QueryResult;

use labile\thief\Types\Inline\InlineKeyboardMarkup;
use labile\thief\Types\Inline\InputMessageContent;

/**
 * Class InlineQueryResultArticle
 * Represents a link to an article or web page.
 *
 */
class Article extends AbstractInlineQueryResult
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['type', 'id', 'title', 'input_message_content'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'type' => true,
        'id' => true,
        'title' => true,
        'input_message_content' => InputMessageContent::class,
        'reply_markup' => InlineKeyboardMarkup::class,
        'url' => true,
        'hide_url' => true,
        'description' => true,
        'thumbnail_url' => true,
        'thumbnail_width' => true,
        'thumbnail_height' => true,
    ];

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected string $type = 'article';

    /**
     * Optional. URL of the result
     *
     * @var string|null
     */
    protected ?string $url;

    /**
     * Optional. Pass True, if you don't want the URL to be shown in the message
     *
     * @var bool|null
     */
    protected ?bool $hideUrl;

    /**
     * Optional. Short description of the result
     *
     * @var string|null
     */
    protected ?string $description;

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
     * InlineQueryResultArticle constructor.
     *
     * @param string $id
     * @param string $title
     * @param string|null $description
     * @param string|null $thumbnailUrl
     * @param int|null $thumbnailWidth
     * @param int|null $thumbnailHeight
     * @param InputMessageContent|null $inputMessageContent
     * @param InlineKeyboardMarkup|null $inlineKeyboardMarkup
     */
    public function __construct(
        string               $id,
        string               $title,
                             $description = null,
                             $thumbnailUrl = null,
        int                  $thumbnailWidth = null,
        int                  $thumbnailHeight = null,
        InputMessageContent  $inputMessageContent = null,
        InlineKeyboardMarkup $inlineKeyboardMarkup = null
    ) {
        parent::__construct($id, $title, $inputMessageContent, $inlineKeyboardMarkup);

        $this->description = $description;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return bool|null
     */
    public function isHideUrl(): ?bool
    {
        return $this->hideUrl;
    }

    /**
     * @param bool|null $hideUrl
     *
     * @return void
     */
    public function setHideUrl(?bool $hideUrl): void
    {
        $this->hideUrl = $hideUrl;
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
