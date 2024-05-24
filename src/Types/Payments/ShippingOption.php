<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;


use labile\thief\Types\BaseType;

/**
 * Class ShippingOption
 * This object represents one shipping option.
 *
 */
class ShippingOption extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['id', 'title', 'prices'];

    /**
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'title' => true,
        'prices' => ArrayOfLabeledPrice::class
    ];

    /**
     * Shipping option identifier
     *
     * @var string
     */
    protected string $id;

    /**
     * Option title
     *
     * @var string
     */
    protected string $title;

    /**
     * List of price portions
     *
     * @var array
     */
    protected array $prices;

    /**
     * @author MY
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return void
     *@author MY
     *
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @author MY
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return void
     *@author MY
     *
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @author MY
     * @return array
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param array $prices
     *
     * @return void
     *@author MY
     *
     */
    public function setPrices(array $prices): void
    {
        $this->prices = $prices;
    }
}
