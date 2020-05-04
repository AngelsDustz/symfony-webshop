<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice extends AbstractEntity
{
    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="invoices")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     *
     * @return self
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
