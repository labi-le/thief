<?php
declare(strict_types=1);

namespace labile\thief\Types;


/**
 * Class Contact
 * This object represents a phone contact.
 *
 */
class Contact extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $requiredParams = ['phone_number', 'first_name'];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static array $map = [
        'phone_number' => true,
        'first_name' => true,
        'last_name' => true,
        'user_id' => true,
        'vcard' => true,
    ];

    /**
     * Contact's phone number
     *
     * @var string
     */
    protected string $phoneNumber;

    /**
     * Contact's first name
     *
     * @var string
     */
    protected string $firstName;

    /**
     * Optional. Contact's last name
     *
     * @var string|null
     */
    protected ?string $lastName;

    /**
     * Optional. Contact's user identifier in Telegram
     *
     * @var int|null
     */
    protected ?int $userId;

    /**
     * Optional. Additional data about the contact in the form of a vCard
     *
     * @var string|null
     */
    protected ?string $vcard;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return void
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return null|string
     */
    public function getVCard(): ?string
    {
        return $this->vcard;
    }

    /**
     * @param string $vcard
     * @return void
     */
    public function setVCard(string $vcard): void
    {
        $this->vcard = $vcard;
    }
}
