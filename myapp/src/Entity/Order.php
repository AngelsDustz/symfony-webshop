<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order extends AbstractEntity
{
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
}
