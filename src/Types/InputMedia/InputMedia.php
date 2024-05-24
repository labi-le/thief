<?php
declare(strict_types=1);

namespace labile\thief\Types\InputMedia;

use labile\thief\Collection\CollectionItemInterface;
use labile\thief\Types\BaseType;

/**
 * Class InputMedia
 * This object represents the content of a media message to be sent.
 *
 */
class InputMedia extends BaseType implements CollectionItemInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['type', 'media'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'type' => true,
        'media' => true,
        'caption' => true,
        'parse_mode' => true,
    ];

    /**
     * Type of the result.
     *
     * @var string
     */
    protected string $type;

    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>"
     * to upload a new one using multipart/form-data under <file_attach_name> name.
     *
     * @var string
     */
    protected string $media;

    /**
     * Optional. Caption of the photo to be sent, 0-200 characters.
     *
     * @var string|null
     */
    protected ?string $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic,
     * fixed-width text or inline URLs in the media caption.
     *
     * @var string|null
     */
    protected ?string $parseMode;

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
    public function getMedia(): string
    {
        return $this->media;
    }

    /**
     * @param string $media
     *
     * @return void
     */
    public function setMedia(string $media): void
    {
        $this->media = $media;
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

    /**
     * @return string|null
     */
    public function getParseMode(): ?string
    {
        return $this->parseMode;
    }

    /**
     * @param string|null $parseMode
     *
     * @return void
     */
    public function setParseMode(?string $parseMode): void
    {
        $this->parseMode = $parseMode;
    }
}
