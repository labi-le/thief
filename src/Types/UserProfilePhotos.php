<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class UserProfilePhotos
 * This object represent a user's profile pictures.
 *
 */
class UserProfilePhotos extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['total_count', 'photos'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'total_count' => true,
        'photos' => ArrayOfArrayOfPhotoSize::class,
    ];

    /**
     * Total number of profile pictures the target user has
     *
     * @var int
     */
    protected int $totalCount;

    /**
     * Requested profile pictures (in up to 4 sizes each).
     * Array of Array of \TelegramBot\Api\Types\PhotoSize
     *
     * @var array
     */
    protected array $photos;

    /**
     * @return array
     */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    /**
     * @param array $photos
     *
     * @return void
     */
    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @param mixed $totalCount
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function setTotalCount(mixed $totalCount): void
    {
        if (is_integer($totalCount)) {
            $this->totalCount = $totalCount;
        } else {
            throw new InvalidArgumentException();
        }
    }
}
