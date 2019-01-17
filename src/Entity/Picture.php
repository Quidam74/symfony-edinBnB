<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Property")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

}
