<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order extends AbstractEntity
{
    /**
     * @var Collection<int, OrderLine>
     *
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="order")
     */
    private $orderLines;

    /**
     * @var Collection<int, Invoice>
     *
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="order")
     */
    private $invoices;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Order Constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->orderLines = new ArrayCollection();
        $this->invoices   = new ArrayCollection();

        $this
            ->setUser($user)
        ;
    }

    /**
     * @return Collection<int, OrderLine>
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine $orderLine
     *
     * @return self
     */
    public function addOrderLine(OrderLine $orderLine): self
    {
        if (false === $this->orderLines->contains($orderLine)) {
            $this->orderLines->add($orderLine);
        }

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    /**
     * @param Invoice $invoice
     *
     * @return self
     */
    public function addInvoice(Invoice $invoice): self
    {
        if (false === $this->invoices->contains($invoice)) {
            $this->invoices->add($invoice);
        }

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
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
