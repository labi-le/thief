<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;


use labile\thief\Types\BaseType;

/**
 * Class SuccessfulPayment
 * This object contains basic information about a successful payment.
 *
 */
class SuccessfulPayment extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = [
        'currency',
        'total_amount',
        'invoice_payload',
        'telegram_payment_charge_id',
        'provider_payment_charge_id'
    ];

    /**
     * @var array
     */
    protected static array $map = [
        'currency' => true,
        'total_amount' => true,
        'invoice_payload' => true,
        'shipping_option_id' => true,
        'order_info' => OrderInfo::class,
        'telegram_payment_charge_id' => true,
        'provider_payment_charge_id' => true
    ];

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
     * @var array
     */
    protected array $invoicePayload;

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
     * Telegram payment identifier
     *
     * @var string
     */
    protected string $telegramPaymentChargeId;

    /**
     * Provider payment identifier
     *
     * @var string
     */
    protected string $providerPaymentChargeId;

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
     * @author MY
     * @return array
     */
    public function getInvoicePayload(): array
    {
        return $this->invoicePayload;
    }

    /**
     * @param array $invoicePayload
     *
          * @return void
     *@author MY
     *
     */
    public function setInvoicePayload(array $invoicePayload): void
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
     * @return string
     */
    public function getTelegramPaymentChargeId(): string
    {
        return $this->telegramPaymentChargeId;
    }

    /**
     * @param string $telegramPaymentChargeId
     *
     * @return void
     *@author MY
     *
     */
    public function setTelegramPaymentChargeId(string $telegramPaymentChargeId): void
    {
        $this->telegramPaymentChargeId = $telegramPaymentChargeId;
    }

    /**
     * @return string
     *@author MY
     */
    public function getProviderPaymentChargeId(): string
    {
        return $this->providerPaymentChargeId;
    }

    /**
     * @author MY
     *
     * @param mixed $providerPaymentChargeId
     *
     * @return void
     */
    public function setProviderPaymentChargeId(mixed $providerPaymentChargeId): void
    {
        $this->providerPaymentChargeId = $providerPaymentChargeId;
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
