<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineRepository")
 * @ORM\Table(name="order_lines")
 */
class OrderLine extends AbstractEntity
{
    /**
     * @var Collection<int, Order>
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="orderLine")
     */
    private $orders;

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
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
}
