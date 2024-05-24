<?php
declare(strict_types=1);

namespace labile\thief\Types;


class ChatPhoto extends BaseType
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['small_file_id', 'big_file_id'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'small_file_id' => true,
        'big_file_id' => true,
    ];

    /**
     * Unique file identifier of small (160x160) chat photo. This file_id can be used only for photo download.
     *
     * @var string
     */
    protected string $smallFileId;

    /**
     * Unique file identifier of big (640x640) chat photo. This file_id can be used only for photo download.
     *
     * @var string
     */
    protected string $bigFileId;

    /**
     * @return string
     */
    public function getSmallFileId(): string
    {
        return $this->smallFileId;
    }

    /**
     * @param string $smallFileId
     * @return void
     */
    public function setSmallFileId(string $smallFileId): void
    {
        $this->smallFileId = $smallFileId;
    }

    /**
     * @return string
     */
    public function getBigFileId(): string
    {
        return $this->bigFileId;
    }

    /**
     * @param string $bigFileId
     * @return void
     */
    public function setBigFileId(string $bigFileId): void
    {
        $this->bigFileId = $bigFileId;
    }
}
