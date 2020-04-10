<?php

namespace App\Entity;

use App\Entity\User;
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

}
