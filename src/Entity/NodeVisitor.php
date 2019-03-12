<?php

namespace App\Entity;

use App\Entity\NodeProperty;
use App\Entity\VisitorConsultProperty;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 * @OGM\Node(label="Visitor")
 */
class NodeVisitor {

    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="string") */
    protected $name;

    /** @OGM\Property(type="int") */
    protected $age;

    /**
    * @var VisitorConsultProperty[]|Collection
    *
     * @OGM\Relationship(relationshipEntity="VisitorConsultProperty", type="CONSULT", direction="INCOMING", collection=true, mappedBy="visitor")
    */
    protected $consults;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
        $this->consults = new Collection();
    }

    public function visitProperty(NodeProperty $property, EntityManagerInterface $emi)
    {
        $visit = null;

        // Check if the RelationShip are not already created
        foreach($this->getConsults() as $consult) {
            if ($ssproperty->getId() == $consult->getProperty()->getId()) {
                $visit = $consult;
                break;
            }
        }

        if ($visit == null) {
            $visit = new VisitorConsultProperty($this, $property, 0);
            $this->getConsults()->add($visit);
            $property->getConsults()->add($visit);
        }
        
        $visit->addVisitCount();

        // $emi->persist($visit);
        $emi->persist($this);
        $emi->persist($property);

        $emi->flush();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
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