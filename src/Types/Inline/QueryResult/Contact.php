<?php
declare(strict_types=1);

namespace labile\thief\Types\Inline\QueryResult;

use labile\thief\Types\Inline\InlineKeyboardMarkup;
use labile\thief\Types\Inline\InputMessageContent;

class Contact extends AbstractInlineQueryResult
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['type', 'id', 'phone_number', 'first_name'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'type' => true,
        'id' => true,
        'phone_number' => true,
        'first_name' => true,
        'last_name' => true,
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
        'thumbnail_url' => true,
        'thumbnail_width' => true,
        'thumbnail_height' => true,
    ];

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected string $type = 'contact';

    /**
     * Contact's phone number
     *
     * @var string
     */
    protected string $phoneNumber;

    /**
     * Contact's first name
     *
     * @var string
     */
    protected string $firstName;

    /**
     * Optional. Contact's last name
     *
     * @var string|null
     */
    protected ?string $lastName;

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
     * Contact constructor.
     *
     * @param string $id
     * @param string $phoneNumber
     * @param string $firstName
     * @param string $lastName
     * @param string|null $thumbnailUrl
     * @param int|null $thumbnailWidth
     * @param int|null $thumbnailHeight
     * @param InputMessageContent|null $inputMessageContent
     * @param InlineKeyboardMarkup|null $inlineKeyboardMarkup
     */
    public function __construct(
        string               $id,
        string               $phoneNumber,
                             $firstName,
                             $lastName = null,
        string               $thumbnailUrl = null,
        int                  $thumbnailWidth = null,
        int                  $thumbnailHeight = null,
        InputMessageContent  $inputMessageContent = null,
        InlineKeyboardMarkup $inlineKeyboardMarkup = null
    ) {
        parent::__construct($id, null, $inputMessageContent, $inlineKeyboardMarkup);

        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return void
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     *
     * @return void
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
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
