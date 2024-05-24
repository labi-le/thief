<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class Video
 * This object represents a video file.
 *
 */
class Video extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['file_id', 'file_unique_id', 'width', 'height', 'duration'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'width' => true,
        'height' => true,
        'duration' => true,
        'thumbnail' => PhotoSize::class,
        'mime_type' => true,
        'file_size' => true
    ];

    /**
     * Unique identifier for this file
     *
     * @var string
     */
    protected string $fileId;

    /**
     * Video width as defined by sender
     *
     * @var int
     */
    protected int $width;

    /**
     * Video height as defined by sender
     *
     * @var int
     */
    protected int $height;

    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var int
     */
    protected int $duration;

    /**
     * Video thumbnail
     *
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail;

    /**
     * Optional. Mime type of a file as defined by sender
     *
     * @var string|null
     */
    protected ?string $mimeType;

    /**
     * Optional. File size
     *
     * @var int|null
     */
    protected ?int $fileSize;

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    protected string $fileUniqueId;

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setDuration(mixed $duration): void
    {
        if (is_integer($duration)) {
            $this->duration = $duration;
        } else {
            throw new InvalidArgumentException();
        }
    }

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
     * @return null|string
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return void
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return PhotoSize|null
     */
    public function getThumbnail(): ?PhotoSize
    {
        return $this->thumbnail;
    }

    /**
     * @param PhotoSize|null $thumbnail
     *
     * @return void
     */
    public function setThumbnail(?PhotoSize $thumbnail): void
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
     * @param PhotoSize|null $thumb
     *
     * @return void
     *@deprecated use setThumbnail method
     *
     */
    public function setThumb(?PhotoSize $thumb): void
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
}
