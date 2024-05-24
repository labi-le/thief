<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments;


use labile\thief\Types\BaseType;

/**
 * Class OrderInfo
 * This object represents information about an order.
 *
 */
class OrderInfo extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = [];

    /**
     * @var array
     */
    protected static array $map = [
        'name' => true,
        'phone_number' => true,
        'email' => true,
        'shipping_address' => ShippingAddress::class
    ];

    /**
     * Optional. User name
     *
     * @var string|null
     */
    protected ?string $name;

    /**
     * Optional. User's phone number
     *
     * @var string|null
     */
    protected ?string $phoneNumber;

    /**
     * Optional. User email
     *
     * @var string|null
     */
    protected ?string $email;

    /**
     * Optional. User shipping address
     *
     * @var ShippingAddress|null
     */
    protected ?ShippingAddress $shippingAddress;

    /**
     * @author MY
     *
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     *@author MY
     *
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @author MY
     *
     * @return null|string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
          * @return void
     *@author MY
     *
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @author MY
     *
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return void
     *@author MY
     *
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @author MY
     *
     * @return ShippingAddress|null
     */
    public function getShippingAddress(): ?ShippingAddress
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
