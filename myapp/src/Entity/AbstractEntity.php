<?php

declare(strict_types=1);

namespace App\Entity;

use Cocur\Slugify\Slugify;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity
{
    /**
     * ID.
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     *
     * @var UuidInterface
     */
    protected $id;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var Slugify|null
     */
    protected $slugify;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->id        = Uuid::uuid4();
        $this->createdAt = new DateTime('now');
    }

    /**
     * @ORM\PrePersist
     *
     * @return void
     */
    public function prePersist(): void
    {
        $this->createdAt = new DateTime('now');
    }

    /**
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTime('now');
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return Slugify
     */
    protected function getSlugify(): Slugify
    {
        if (null === $this->slugify) {
            $this->slugify = new Slugify();
        }

        return $this->slugify;
    }
}
