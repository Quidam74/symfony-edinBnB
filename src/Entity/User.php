<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=60)
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $roles = [];

    /**
     * @ORM\Column(type="date")
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     * @MaxDepth(1)
     */
    private $hashPassword;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $bankingReference;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $isTraveler;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist"})
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Travel", mappedBy="user")
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $travels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Property", mappedBy="user")
     * @Groups({"user"})
     * @MaxDepth(1)
     */
    private $properties;

    public function __construct()
    {
        $this->travels = new ArrayCollection();
        $this->properties = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->hashPassword;
    }

    public function setPassword(string $password): self
    {
        $this->hashPassword = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $travel->setUser($this);
        }

        return $this;
    }

    public function removeTravel(Travel $travel): self
    {
        if ($this->travels->contains($travel)) {
            $this->travels->removeElement($travel);
            // set the owning side to null (unless already changed)
            if ($travel->getUser() === $this) {
                $travel->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setUser($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getUser() === $this) {
                $property->setUser(null);
            }
        }

        return $this;
    }
}
