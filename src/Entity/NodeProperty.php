<?php

namespace App\Entity;

use App\Entity\NodeVisitor;
use App\Entity\VisitorConsultProperty;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 * @OGM\Node(label="Property")
 */
class NodeProperty {

    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="string") */
    protected $description;

    /** @OGM\Property(type="string") */
    protected $address;

    /** @OGM\Property(type="int") */
    protected $idProperty;

    /**
    * @var VisitorConsultProperty[]|Collection
    *
     * @OGM\Relationship(relationshipEntity="VisitorConsultProperty", type="CONSULT", direction="OUTGOING", collection=true, mappedBy="property")
    */
   protected $consults;

    public function __construct(string $description, string $address, int $idProperty) {
        $this->description = $description;
        $this->address = $address;
        $this->idProperty = $idProperty;
        $this->consults = new Collection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $desciption
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getIdProperty()
    {
        return $this->idProperty;
    }

    /**
     * @param mixed $address
     */
    public function setIdProperty($idProperty): void
    {
        $this->idProperty = $idProperty;
    }

    /**
     * @return Collection|VisitorConsultProperty[]
     */
    public function getConsults()
    {
        return $this->consults;
    }

    public function addConsult(VisitorConsultProperty $consult): self
    {
        if (!$this->consults->contains($consult)) {
            $this->consults[] = $consult;
        }

        return $this;
    }

    public function removeConsult(VisitorConsultProperty $consult): self
    {
        if ($this->consults->contains($consult)) {
            $this->consults->removeElement($consult);
        }

        return $this;
    }
}