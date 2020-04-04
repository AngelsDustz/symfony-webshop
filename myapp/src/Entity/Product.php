<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\table(name="products")
 */
class Product extends AbstractEntity
{
    /**
     * @var string Name of the product.
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var int Price of the product in cents.
     * 
     * @ORM\Column(type="string")
     */
    private $price;

    /**
     * Product Constructor.
     *
     * @param string $name
     * @param int    $price
     */
    public function __construct(string $name, int $price)
    {
        parent::__construct();

        $this
            ->setName($name)
            ->setPrice($price)
        ;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * 
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * 
     * @return self
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
