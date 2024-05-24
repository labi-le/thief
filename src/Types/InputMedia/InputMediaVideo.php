<?php
declare(strict_types=1);

namespace labile\thief\Types\InputMedia;

/**
 * Class InputMediaVideo
 * Represents a video to be sent.
 *
 */
class InputMediaVideo extends InputMedia
{
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
        'width' => true,
        'height' => true,
        'duration' => true,
        'supports_streaming' => true
    ];

    /**
     * Optional. Video width.
     *
     * @var int|null
     */
    protected ?int $width;

    /**
     * Optional. Video height.
     *
     * @var int|null
     */
    protected ?int $height;

    /**
     * Optional. Video duration.
     *
     * @var int|null
     */
    protected ?int $duration;

    /**
     * Optional. Pass True, if the uploaded video is suitable for streaming.
     *
     * @var bool|null
     */
    protected ?bool $supportsStreaming;

    /**
     * InputMediaVideo constructor.
     *
     * @param string $media
     * @param string|null $caption
     * @param string|null $parseMode
     * @param int|null $width
     * @param int|null $height
     * @param int|null $duration
     * @param bool $supportsStreaming
     */
    public function __construct(
        string $media,
        string $caption = null,
        string $parseMode = null,
        int    $width = null,
        int    $height = null,
        int    $duration = null,
        bool   $supportsStreaming = false
    ) {
        $this->type = 'video';
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->supportsStreaming = $supportsStreaming;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     *
     * @return void
     */
    public function setWidth(?int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     *
     * @return void
     */
    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     *
     * @return void
     */
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return bool|null
     */
    public function getSupportsStreaming(): ?bool
    {
        return $this->supportsStreaming;
    }

    /**
     * @param bool|null $supportsStreaming
     *
     * @return void
     */
    public function setSupportsStreaming(?bool $supportsStreaming): void
    {
        $this->supportsStreaming = $supportsStreaming;
    }
}
