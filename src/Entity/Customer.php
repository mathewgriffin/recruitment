<?php

namespace App\Entity;

use Core\Error\MissingEntityDetailException;
use Core\Model\ModelInterface;

/**
 * Class Customer
 *
 * @package App\Entity
 */
class Customer implements ModelInterface
{
    /** @var integer */
    private $id;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $address;

    /** @var string */
    private $twitterAlias;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function setId(int $id): Customer
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName(string $firstName): Customer
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Customer
     */
    public function setLastName(string $lastName): Customer
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress(string $address): Customer
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTwitterAlias(): ?string
    {
        return $this->twitterAlias;
    }

    /**
     * @param null|string $twitterAlias
     *
     * @return Customer
     */
    public function setTwitterAlias(?string $twitterAlias): Customer
    {
        $this->twitterAlias = $twitterAlias;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormattedName(): string
    {

        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * @param array $row
     *
     * @return Customer|mixed
     * @throws MissingEntityDetailException
     */
    public static function hydrate(array $row)
    {
        if (!isset($row['id']) ||  !isset($row['firstName']) || !isset($row['lastName']))
        {
            throw new MissingEntityDetailException('You must provide a firstName and lastName to create a customer');
        }

        $customer = new Customer();
        $customer->setFirstName($row['firstName'])
            ->setLastName($row['lastName'])
            ->setAddress($row['address'])
            ->setTwitterAlias($row['twitterAlias'] ?? null)
            ->setId($row['id'] ?? null);

        return $customer;
    }
}
