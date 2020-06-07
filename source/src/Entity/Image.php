<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image extends AbstractEntity
{
    /**
     * @var string Title of the image
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string Alt text of the image
     *
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @var string Guessed MimeType of image
     *
     * @ORM\Column(type="string", length=255)
     */
    private $mimeType;

    /**
     * @var string relative path, where image is stored
     *
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return Image
     */
    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Image
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
