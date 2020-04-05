<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order extends AbstractEntity
{
    /**
     * A new order
     */
    public const STATUS_NEW = 0;

    /**
     * The order has been paid for
     */
    public const STATUS_PAID = 50;

    /**
     * The order was cancelled
     */
    public const STATUS_CANCELLED = 100;

    /**
     * Collection of all Statuses
     */
    public const STATUSES = [
        self::STATUS_NEW        => 'new',
        self::STATUS_PAID       => 'paid',
        self::STATUS_CANCELLED  => 'cancelled',
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
     * @var OrderLine
     *
     * @ORM\ManyToOne(targetEntity="OrderLine", inversedBy="orders")
     * @ORM\JoinColumn(name="order_line_id", referencedColumnName="id")
     */
    private $orderLine;

    /**
     * @var int status of the order @see STATUSES
     */
    private $status;

    /**
     * @param Product   $product
     * @param OrderLine $orderLine
     * @param int       $tax
     */
    public function __construct(Product $product, OrderLine $orderLine, int $tax)
    {
        parent::__construct();

        $this
            ->setProduct($product)
            ->setOrderLine($orderLine)
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
        $this->product = $product;
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
     * @return OrderLine
     */
    public function getOrderLine(): OrderLine
    {
        return $this->orderLine;
    }

    /**
     * @param OrderLine $orderLine
     *
     * @return self
     */
    public function setOrderLine(OrderLine $orderLine): self
    {
        $this->orderLine = $orderLine;

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
     * @param integer $status
     * 
     * @throws InvalidArgumentException
     * 
     * @return self
     */
    public function setStatus(int $status): self
    {
        if (false === in_array($status, self::STATUSES)) {
            throw new InvalidArgumentException(sprintf(
                'Status %d is not a valid status',
                $status
            ));
        }

        $this->status = $status;

        return $this;
    }
}
