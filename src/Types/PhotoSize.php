<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class PhotoSize
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 */
class PhotoSize extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['file_id', 'file_unique_id', 'width', 'height'];

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
        'file_size' => true,
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
    protected int $width;

    /**
     * Photo height
     *
     * @var int
     */
    protected int $height;

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
