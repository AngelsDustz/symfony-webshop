<?php

namespace App\Entity;

use App\Entity\Order;
use App\Entity\Address;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends AbstractEntity implements UserInterface
{
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var Collection<int, Order>
     * 
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user")
     */
    private $orders;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var Collection<int, Address>
     * 
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    private $addresses;

    /**
     * @param string $email
     */
    public function __construct(string $email, string $firstName, string $lastName)
    {
        parent::__construct();

        $this
            ->setEmail($email)
            ->setOrders(new ArrayCollection())
        ;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * 
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
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
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param Collection<int, Order> $collection
     * 
     * @return self
     */
    public function setOrders(Collection $collection): self
    {
        $this->orders = $collection;

        return $this;
    }

    /**
     * @param Order $order
     * 
     * @return self
     */
    public function addOrder(Order $order): self
    {
        if (false === $this->orders->contains($order)) {
            $this->orders->add($order);
        }

        return $this;
    }
    
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }
}
