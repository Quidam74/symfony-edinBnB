<?php

namespace App\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

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

    public function __construct(string $description, string $address, int $idProperty) {
        $this->description = $description;
        $this->address = $address;
        $this->idProperty = $idProperty;
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
}