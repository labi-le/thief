<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments\Query;

use labile\thief\Types\BaseType;
use labile\thief\Types\Payments\OrderInfo;
use labile\thief\Types\User;

/**
 * Class PreCheckoutQuery
 * This object contains information about an incoming pre-checkout query.
 *
 */
class PreCheckoutQuery extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['id', 'from', 'currency', 'total_amount', 'invoice_payload'];

    /**
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'from' => User::class,
        'currency' => true,
        'total_amount' => true,
        'invoice_payload' => true,
        'shipping_option_id' => true,
        'order_info' => OrderInfo::class
    ];

    /**
     * Unique query identifier
     *
     * @var string
     */
    protected string $id;

    /**
     * User who sent the query
     *
     * @var User
     */
    protected User $from;

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
     * Bot specified invoice payload
     *
     * @var string
     */
    protected string $invoicePayload;

    /**
     * Optional. Identifier of the shipping option chosen by the user
     *
     * @var string|null
     */
    protected ?string $shippingOptionId;

    /**
     * Optional. Order info provided by the user
     *
     * @var OrderInfo|null
     */
    protected ?OrderInfo $orderInfo;

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
     * @return User
     */
    public function getFrom(): User
    {
        return $this->from;
    }

    /**
     * @param User $from
     *
     * @return void
     *@author MY
     *
     */
    public function setFrom(User $from): void
    {
        $this->from = $from;
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

    /**
     * @return string
     *@author MY
     */
    public function getInvoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * @author MY
     *
     * @param mixed $invoicePayload
     *
     * @return void
     */
    public function setInvoicePayload(mixed $invoicePayload): void
    {
        $this->invoicePayload = $invoicePayload;
    }

    /**
     * @author MY
     *
     * @return null|string
     */
    public function getShippingOptionId(): ?string
    {
        return $this->shippingOptionId;
    }

    /**
     * @param string $shippingOptionId
     *
     * @return void
     *@author MY
     *
     */
    public function setShippingOptionId(string $shippingOptionId): void
    {
        $this->shippingOptionId = $shippingOptionId;
    }

    /**
     * @author MY
     *
     * @return OrderInfo|null
     */
    public function getOrderInfo(): ?OrderInfo
    {
        return $this->orderInfo;
    }

    /**
     * @param OrderInfo $orderInfo
     *
          * @return void
     *@author MY
     *
     */
    public function setOrderInfo(OrderInfo $orderInfo): void
    {
        $this->orderInfo = $orderInfo;
    }
}
