<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user", "availability", "property", "travel"})
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $bedRoomCount;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $bedCount;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $personCount;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $bathRoomCount;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="property", fetch="EAGER")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $pictures;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist"}, fetch="EAGER")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Availability", mappedBy="property")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $availabilities;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Equipment")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $equipments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Travel", mappedBy="property")
     * @Groups({"property"})
     * @MaxDepth(1)
     */
    private $travels;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->availabilities = new ArrayCollection();
        $this->equipments = new ArrayCollection();
        $this->travels = new ArrayCollection();
    }

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBedRoomCount(): ?int
    {
        return $this->bedRoomCount;
    }

    public function setBedRoomCount(int $bedRoomCount): self
    {
        $this->bedRoomCount = $bedRoomCount;

        return $this;
    }

    public function getBedCount(): ?int
    {
        return $this->bedCount;
    }

    public function setBedCount(int $bedCount): self
    {
        $this->bedCount = $bedCount;

        return $this;
    }

    public function getPersonCount(): ?int
    {
        return $this->personCount;
    }

    public function setPersonCount(int $personCount): self
    {
        $this->personCount = $personCount;

        return $this;
    }

    public function getBathRoomCount(): ?int
    {
        return $this->bathRoomCount;
    }

    public function setBathRoomCount(int $bathRoomCount): self
    {
        $this->bathRoomCount = $bathRoomCount;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Availability[]
     */
    public function getAvailabilities(): Collection
    {
        return $this->availabilities;
    }

    public function addAvailability(Availability $availability): self
    {
        if (!$this->availabilities->contains($availability)) {
            $this->availabilities[] = $availability;
            $availability->setProperty($this);
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): self
    {
        if ($this->availabilities->contains($availability)) {
            $this->availabilities->removeElement($availability);
            // set the owning side to null (unless already changed)
            if ($availability->getProperty() === $this) {
                $availability->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipments->contains($equipment)) {
            $this->equipments->removeElement($equipment);
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

    /**
     * @return Collection|Travel[]
     */
    public function getTravels(): Collection
    {
        return $this->travels;
    }

    public function addTravel(Travel $travel): self
    {
        if (!$this->travels->contains($travel)) {
            $this->travels[] = $travel;
            $travel->setProperty($this);
        }

        return $this;
    }

    public function removeTravel(Travel $travel): self
    {
        if ($this->travels->contains($travel)) {
            $this->travels->removeElement($travel);
            // set the owning side to null (unless already changed)
            if ($travel->getProperty() === $this) {
                $travel->setProperty(null);
            }
        }

        return $this;
    }
}
