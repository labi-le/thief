<?php
declare(strict_types=1);

namespace labile\thief\Types;

use InvalidArgumentException;

/**
 * Class Animation
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 */
class Animation extends BaseType implements TypeInterface
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
        'file_name' => true,
        'mime_type' => true,
        'file_size' => true
    ];

    /**
     * Unique file identifier
     *
     * @var string
     */
    protected string $fileId;

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    protected string $fileUniqueId;

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
     * @var PhotoSize
     */
    protected PhotoSize $thumbnail;

    /**
     * Optional. Animation thumbnail as defined by sender
     *
     * @var string|null
     */
    protected ?string $fileName;

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
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     * @return void
     * @throws InvalidArgumentException
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
     * @return void
     */
    public function setFileId(string $fileId): void
    {
        $this->fileId = $fileId;
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
     * @return void
     */
    public function setFileUniqueId(string $fileUniqueId): void
    {
        $this->fileUniqueId = $fileUniqueId;
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
     * @return void
     * @throws InvalidArgumentException
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
     * @return void
     * @throws InvalidArgumentException
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
     * @return void
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return PhotoSize
     */
    public function getThumbnail(): PhotoSize
    {
        return $this->thumbnail;
    }

    /**
     * @param PhotoSize $thumbnail
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
     * @return null|string $fileName
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return void
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
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
     * @return void
     * @throws InvalidArgumentException
     */
    public function setWidth(mixed $width): void
    {
        if (is_integer($width)) {
            $this->width = $width;
        } else {
            throw new InvalidArgumentException();
        }
    }
}
