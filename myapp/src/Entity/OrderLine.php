<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineRepository")
 * @ORM\Table(name="order_lines")
 */
class OrderLine extends AbstractEntity
{
    /**
     * A new order.
     */
    public const STATUS_NEW = 0;

    /**
     * The order has been paid for.
     */
    public const STATUS_PAID = 50;

    /**
     * The order was cancelled.
     */
    public const STATUS_CANCELLED = 100;

    /**
     * Collection of all Statuses.
     */
    public const STATUSES = [
        self::STATUS_NEW => 'new',
        self::STATUS_PAID => 'paid',
        self::STATUS_CANCELLED => 'cancelled',
    ];

    /**
     * @var Product the product ordered
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var int price of the product at the moment of ordering
     */
    private $productPrice;

    /**
     * @var int percentage tax
     */
    private $tax;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="orderLines")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @var int status of the order @see STATUSES
     */
    private $status;

    /**
     * @param Product $product
     * @param Order   $order
     * @param int     $tax
     */
    public function __construct(Product $product, Order $order, int $tax)
    {
        parent::__construct();

        $this
            ->setProduct($product)
            ->setOrder($order)
            ->setTax($tax)
            ->setStatus(self::STATUS_NEW)
        ;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product      = $product;
        $this->productPrice = $product->getPrice();

        return $this;
    }

    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return $this->productPrice;
    }

    /**
     * @return int
     */
    public function getTax(): int
    {
        return $this->tax;
    }

    /**
     * @param int $tax
     *
     * @return self
     */
    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

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

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function setStatus(int $status): self
    {
        if (false === \in_array($status, self::STATUSES)) {
            throw new InvalidArgumentException(sprintf('Status %d is not a valid status', $status));
        }

        $this->status = $status;

        return $this;
    }
}
