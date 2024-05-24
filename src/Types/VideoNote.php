<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class VideoNote
 * This object represents a video message (available in Telegram apps as of v.4.0).
 *
 */
class VideoNote extends BaseType implements TypeInterface
{
    protected static array $requiredParams = ['file_id', 'file_unique_id', 'length', 'duration'];

    protected static array $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'length' => true,
        'duration' => true,
        'thumbnail' => PhotoSize::class,
        'file_size' => true,
    ];

    /**
     * Unique identifier for this file
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
     * Video width and height (diameter of the video message) as defined by sender
     *
     * @var int
     */
    protected int $length;

    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var int
     */
    protected int $duration;

    /**
     * Optional. Video thumbnail
     *
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail;

    /**
     * Optional. File size in bytes
     *
     * @var int|null
     */
    protected ?int $fileSize;

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
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return void
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     *
     * @return void
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
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
     * @return int|null
     */
    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     *
     * @return void
     */
    public function setFileSize(int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }
}
