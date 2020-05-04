<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address extends AbstractEntity
{
    /**
     * @var string Housenumber and Addition
     * 
     * @ORM\Column(type="string")
     */
    private $houseNumber;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $postCode;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $district;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $county;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="user", inversedBy="addresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Address constructor.
     *
     * @param User $user
     * @param string $country
     * @param string $postCode
     * @param string $houseNumber
     */
    public function __construct(User $user, string $country, string $postCode, string $houseNumber)
    {
        parent::__construct();

        $this
            ->setUser($user)
            ->setCountry($country)
            ->setPostCode($postCode)
            ->setHouseNumber($houseNumber)
        ;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     *
     * @return Address
     */
    public function setHouseNumber(string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return Address
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     *
     * @return Address
     */
    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return Address
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     *
     * @return Address
     */
    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @param string $county
     *
     * @return Address
     */
    public function setCounty(string $county): self
    {
        $this->county = $county;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Address
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
