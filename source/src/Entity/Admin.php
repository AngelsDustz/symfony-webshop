<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Admin.
 *
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @ORM\Table(name="admins")
 */
class Admin extends AbstractEntity implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $email;

    /**
     * @var array<string>
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * Admin constructor.
     *
     * @param string      $username
     * @param string      $password
     * @param string|null $email
     */
    public function __construct(string $username, string $password, ?string $email)
    {
        parent::__construct();

        $this
            ->setUsername($username)
            ->setPassword($password)
            ->setEmail($email)
        ;
    }

    /**
     * @see UserInterface
     *
     * @return array<string>
     */
    public function getRoles()
    {
        $roles = $this->roles;

        // guarantee every admin is ROLE_ADMIN
        $roles[] = 'ROLE_ADMIN';

        return array_unique($roles);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return void
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $username
     *
     * @return Admin
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
