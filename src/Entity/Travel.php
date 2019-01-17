<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TravelRepository")
 */
class Travel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user", "property", "travel"})
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Day", cascade={"persist"})
     * @Groups({"travel"})
     * @MaxDepth(1)
     */
    private $days;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"travel"})
     * @MaxDepth(1)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Property")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"travel"})
     * @MaxDepth(1)
     */
    private $property;

    public function __construct()
    {
        $this->days = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Day[]
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days[] = $day;
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->days->contains($day)) {
            $this->days->removeElement($day);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
