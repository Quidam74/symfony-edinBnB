<?php

namespace App\Entity;

use App\Entity\NodeVisitor;
use App\Entity\NodeProperty;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 *
 * @OGM\RelationshipEntity(type="CONSULT")
 */
class VisitorConsultProperty
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var NodeVisitor
     *
     * @OGM\StartNode(targetEntity="NodeVisitor")
     */
    protected $visitor;

    /**
     * @var NodeProperty
     *
     * @OGM\EndNode(targetEntity="NodeProperty")
     */
    protected $property;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $visitCount;

    public function __construct(NodeVisitor $visitor, NodeProperty $property, int $visitCount)
    {
        $this->visitor = $visitor;
        $this->property = $property;
        $this->visitCount = $visitCount;
    }

    public function addVisitCount()
    {
      $this->visitCount ++;
    }

    public function getId()
    {
      return $this->id;
    }

    public function setId($id)
    {
      $this->id = $id;
    }

    public function getVisitor(): NodeVisitor
    {
      return $this->visitor;
    }

    public function setVisitor(NodeVisitor $visitor)
    {
      $this->visitor = $visitor;
    }

    public function getProperty(): NodeProperty
    {
      return $this->property;
    }

    public function setProperty(NodeProperty $property)
    {
      $this->property = $property;
    }

    public function getVisitCount(): int
    {
      return $this->visitCount;
    }

    public function setVisitCount(int $visitCount)
    {
      $this->visitCount = $visitCount;
    }
}