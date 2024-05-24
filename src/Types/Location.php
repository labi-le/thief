<?php
declare(strict_types=1);

namespace labile\thief\Types;


use InvalidArgumentException;

/**
 * Class Location
 * This object represents a point on the map.
 *
 */
class Location extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['latitude', 'longitude'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'latitude' => true,
        'longitude' => true,
        'horizontal_accuracy' => true,
        'live_period' => true,
        'heading' => true,
        'proximity_alert_radius' => true,
    ];

    /**
     * Longitude as defined by sender
     *
     * @var float
     */
    protected float $longitude;

    /**
     * Latitude as defined by sender
     *
     * @var float
     */
    protected float $latitude;

    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     *
     * @var float|null
     */
    protected ?float $horizontalAccuracy;

    /**
     * Optional. Time relative to the message sending date, during which the location can be updated, in seconds. For
     * active live locations only.
     *
     * @var int|null
     */
    protected ?int $livePeriod;

    /**
     * Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
     *
     * @var int|null
     */
    protected ?int $heading;

    /**
     * Optional. Maximum distance for proximity alerts about approaching another chat member, in meters. For sent live
     * locations only.
     *
     * @var int|null
     */
    protected ?int $proximityAlertRadius;

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return void
     * @throws InvalidArgumentException
     */
    public function setLatitude(mixed $latitude): void
    {
        if (is_float($latitude)) {
            $this->latitude = $latitude;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return void
     * @throws InvalidArgumentException
     */
    public function setLongitude(mixed $longitude): void
    {
        if (is_float($longitude)) {
            $this->longitude = $longitude;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return float|null
     */
    public function getHorizontalAccuracy(): ?float
    {
        return $this->horizontalAccuracy;
    }

    /**
     * @param mixed $horizontalAccuracy
     * @return void
     * @throws InvalidArgumentException
     */
    public function setHorizontalAccuracy(mixed $horizontalAccuracy): void
    {
        if (is_float($horizontalAccuracy)) {
            $this->horizontalAccuracy = $horizontalAccuracy;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return int|null
     */
    public function getLivePeriod(): ?int
    {
        return $this->livePeriod;
    }

    /**
     * @param int $livePeriod
     * @return void
     */
    public function setLivePeriod(int $livePeriod): void
    {
        $this->livePeriod = $livePeriod;
    }

    /**
     * @return int|null
     */
    public function getHeading(): ?int
    {
        return $this->heading;
    }

    /**
     * @param int $heading
     * @return void
     */
    public function setHeading(int $heading): void
    {
        $this->heading = $heading;
    }

    /**
     * @return int|null
     */
    public function getProximityAlertRadius(): ?int
    {
        return $this->proximityAlertRadius;
    }

    /**
     * @param int $proximityAlertRadius
     * @return void
     */
    public function setProximityAlertRadius(int $proximityAlertRadius): void
    {
        $this->proximityAlertRadius = $proximityAlertRadius;
    }
}
