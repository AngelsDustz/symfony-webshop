<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\table(name="products")
 */
class Product extends AbstractEntity
{
    /**
     * @var string name of the product
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var int price of the product in cents
     *
     * @ORM\Column(type="string")
     */
    private $price;

    /**
     * @var Collection<int, Category>
     *
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="product")
     */
    private $categories;

    /**
     * @var Collection<int, Image>
     *
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="product_images",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     * )
     */
    private $images;

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
            ->setCategories(new ArrayCollection())
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

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection<int, Category> $categories
     *
     * @return Product
     */
    public function setCategories(Collection $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     *
     * @return $this
     */
    public function addImage(Image $image): self
    {
        if (false === $this->getImages()->contains($image)) {
            $this->getImages()->add($image);
        }

        return $this;
    }
}
