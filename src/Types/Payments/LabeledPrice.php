<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;


use labile\thief\Types\BaseType;

/**
 * Class LabeledPrice
 * This object represents a portion of the price for goods or services.
 *
 */
class LabeledPrice extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['label', 'amount'];

    /**
     * @var array
     */
    protected static array $map = [
        'label' => true,
        'amount' => true
    ];

    /**
     * Portion label
     *
     * @var string
     */
    protected string $label;

    /**
     * Price of the product in the smallest units of the currency (integer, not float/double).
     *
     * @var int
     */
    protected int $amount;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return void
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return void
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}
