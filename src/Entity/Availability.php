<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvailabilityRepository")
 */
class Availability
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"availability"})
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"availability"})
     * @MaxDepth(1)
     */
    private $isAvailable;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Day", cascade={"persist"})
     * @Groups({"availability"})
     * @MaxDepth(1)
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Property")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"availability"})
     * @MaxDepth(1)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;

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
