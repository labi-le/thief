<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class Document
 * This object represents a general file (as opposed to photos and audio files).
 * Telegram users can send files of any type of up to 1.5 GB in size.
 *
 */
class Document extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'thumbnail' => PhotoSize::class,
        'file_name' => true,
        'mime_type' => true,
        'file_size' => true
    ];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['file_id', 'file_unique_id'];

    /**
     * Unique identifier for this file
     *
     * @var string
     */
    protected string $fileId;

    /**
     * Document thumbnail as defined by sender
     *
     * @var PhotoSize
     */
    protected PhotoSize $thumbnail;

    /**
     * Optional. Original filename as defined by sender
     *
     * @var string|null
     */
    protected ?string $fileName;

    /**
     * Optional. MIME type of the file as defined by sender
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
     * @return null|string
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
}
