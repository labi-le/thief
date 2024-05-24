<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class Audio
 * This object represents an audio file (voice note).
 *
 */
class Audio extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['file_id', 'file_unique_id', 'duration'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'duration' => true,
        'performer' => true,
        'title' => true,
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
     * Photo width
     *
     * @var int
     */
    protected int $duration;

    /**
     * Optional. Performer of the audio as defined by sender or by audio tags
     *
     * @var string|null
     */
    protected ?string $performer;

    /**
     * Optional. Title of the audio as defined by sender or by audio tags
     *
     * @var string|null
     */
    protected ?string $title;

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
     * @return null|string
     */
    public function getPerformer(): ?string
    {
        return $this->performer;
    }

    /**
     * @param string $performer
     * @return void
     */
    public function setPerformer(string $performer): void
    {
        $this->performer = $performer;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
