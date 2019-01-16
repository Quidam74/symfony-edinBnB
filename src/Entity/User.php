<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $hashPassword;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $bankingReference;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTraveler;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voyage", mappedBy="user")
     */
    private $voyages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bien", mappedBy="user")
     */
    private $biens;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
        $this->biens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }

    public function setHashPassword(string $hashPassword): self
    {
        $this->hashPassword = $hashPassword;

        return $this;
    }

    public function getBankingReference(): ?string
    {
        return $this->bankingReference;
    }

    public function setBankingReference(string $bankingReference): self
    {
        $this->bankingReference = $bankingReference;

        return $this;
    }

    public function getIsTraveler(): ?bool
    {
        return $this->isTraveler;
    }

    public function setIsTraveler(bool $isTraveler): self
    {
        $this->isTraveler = $isTraveler;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setUser($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->contains($voyage)) {
            $this->voyages->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getUser() === $this) {
                $voyage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Bien $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens[] = $bien;
            $bien->setUser($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->biens->contains($bien)) {
            $this->biens->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getUser() === $this) {
                $bien->setUser(null);
            }
        }

        return $this;
    }
}
