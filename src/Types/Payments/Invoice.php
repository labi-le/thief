<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;


use labile\thief\Types\BaseType;

/**
 * Class Invoice
 * This object contains basic information about an invoice.
 *
 */
class Invoice extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['title', 'description', 'start_parameter', 'currency', 'total_amount'];

    /**
     * @var array
     */
    protected static array $map = [
        'title' => true,
        'description' => true,
        'start_parameter' => true,
        'currency' => true,
        'total_amount' => true,
    ];

    /**
     * Product name
     *
     * @var string
     */
    protected string $title;

    /**
     * Product description
     *
     * @var string
     */
    protected string $description;

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice
     *
     * @var string
     */
    protected string $startParameter;

    /**
     * Three-letter ISO 4217 currency code
     *
     * @var string
     */
    protected string $currency;

    /**
     * Total price in the smallest units of the currency
     *
     * @var integer
     */
    protected int $totalAmount;

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
          * @return void
     *@author MY
     *
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @author MY
     * @return string
     */
    public function getStartParameter(): string
    {
        return $this->startParameter;
    }

    /**
     * @param string $startParameter
     *
          * @return void
     *@author MY
     *
     */
    public function setStartParameter(string $startParameter): void
    {
        $this->startParameter = $startParameter;
    }

    /**
     * @author MY
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return void
     *@author MY
     *
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @author MY
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     *
     * @return void
     *@author MY
     *
     */
    public function setTotalAmount(int $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }
}
