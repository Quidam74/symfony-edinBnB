<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbChambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbLit;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbSalleDeBain;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="bien")
     */
    private $photos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Disponibiliter", mappedBy="bien")
     */
    private $disponibiliters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Equipement", mappedBy="bien")
     */
    private $equipements;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->disponibiliters = new ArrayCollection();
        $this->equipements = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nbChambre;
    }

    public function setNbChambre(int $nbChambre): self
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getNbLit(): ?int
    {
        return $this->nbLit;
    }

    public function setNbLit(int $nbLit): self
    {
        $this->nbLit = $nbLit;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(int $nbPersonne): self
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getNbSalleDeBain(): ?int
    {
        return $this->nbSalleDeBain;
    }

    public function setNbSalleDeBain(int $nbSalleDeBain): self
    {
        $this->nbSalleDeBain = $nbSalleDeBain;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setBien($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getBien() === $this) {
                $photo->setBien(null);
            }
        }

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
     * @return Collection|Disponibiliter[]
     */
    public function getDisponibiliters(): Collection
    {
        return $this->disponibiliters;
    }

    public function addDisponibiliter(Disponibiliter $disponibiliter): self
    {
        if (!$this->disponibiliters->contains($disponibiliter)) {
            $this->disponibiliters[] = $disponibiliter;
            $disponibiliter->setBien($this);
        }

        return $this;
    }

    public function removeDisponibiliter(Disponibiliter $disponibiliter): self
    {
        if ($this->disponibiliters->contains($disponibiliter)) {
            $this->disponibiliters->removeElement($disponibiliter);
            // set the owning side to null (unless already changed)
            if ($disponibiliter->getBien() === $this) {
                $disponibiliter->setBien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipement[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
            $equipement->setBien($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        if ($this->equipements->contains($equipement)) {
            $this->equipements->removeElement($equipement);
            // set the owning side to null (unless already changed)
            if ($equipement->getBien() === $this) {
                $equipement->setBien(null);
            }
        }

        return $this;
    }
}
