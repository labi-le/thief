<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments\Query;

use labile\thief\Types\BaseType;
use labile\thief\Types\Payments\ShippingAddress;
use labile\thief\Types\User;

/**
 * Class ShippingQuery
 * This object contains information about an incoming shipping query.
 *
 */
class ShippingQuery extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['id', 'from', 'invoice_payload', 'shipping_address'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'id' => true,
        'from' => User::class,
        'invoice_payload' => true,
        'shipping_address' => ShippingAddress::class
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
     * Bot specified invoice payload
     *
     * @var string
     */
    protected string $invoicePayload;

    /**
     * User specified shipping address
     *
     * @var ShippingAddress
     */
    protected ShippingAddress $shippingAddress;

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
    public function getInvoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * @param string $invoicePayload
     *
          * @return void
     *@author MY
     *
     */
    public function setInvoicePayload(string $invoicePayload): void
    {
        $this->invoicePayload = $invoicePayload;
    }

    /**
     * @author MY
     * @return ShippingAddress
     */
    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }

    /**
     * @param ShippingAddress $shippingAddress
          *
          * @return void
     *@author MY
     *
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }
}
