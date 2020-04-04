<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends AbstractEntity
{
    /**
     * @var string The user's e-mail address.
     * 
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string User's first name.
     * 
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string User's last name.
     * 
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * User Constructor.
     *
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $email, string $firstName, string $lastName)
    {
        parent::__construct();

        $this
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
        ;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

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
     * @return self
     */
    public function setFirstName(string $firstName): self
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
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
}
