<?php

namespace App\Controller\Web;

use App\Entity\Picture;
use App\Entity\NodeVisitor;
use App\Entity\NodeProperty;
use App\Entity\Property;
use App\Entity\VisitorConsultProperty;
use App\Repository\PictureRepository;
use App\Repository\PropertyRepository;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    public static $SESSION_VISITOR_NAME = 'visitorName';

    /**
     * @Route("/", name="properties")
     */
    public function returnListProperties(PropertyRepository $propertyRepository, EntityManagerInterface $emi)
    {
        $this->getVisitor($emi);

        $properties = $propertyRepository->findAll();

        return $this->render('property/properties.html.twig', [
            'controller_name' => 'ListingController',
            'properties' => $properties,
        ]);
    }

    /**
     * @Route("/property/{propertyId}", name="property", requirements={"propertyId"="\d+"})
     */
    public function index(PropertyRepository $propertyRepository, $propertyId, EntityManagerInterface $emi)
    {
        $property = $propertyRepository->findOneBy(['id'=> $propertyId]);

        // Check if the property is already save in neao4j.
        $nodeProperty = $emi->getRepository(NodeProperty::class)->findOneBy(['idProperty' => $property->getId()]);

        if (!$nodeProperty) {
            // Save property.
            $nodeProperty = new NodeProperty(
                $property->getDescription(),
                $property->getAddress()->getComplement(),
                $property->getId());

            $emi->persist($nodeProperty);
        }

        $visitor = $this->getVisitor($emi);
        $visitor->visitProperty($nodeProperty, $emi);

        return $this->render('property/property.html.twig', [
            'controller_name' => 'ListingController',
            'property' => $property,
        ]);
    }

    private function getVisitor (EntityManagerInterface $emi): NodeVisitor
    {
        // Create the visitor name session.
        $visitorName = uniqid();

        if ($this->get('session')->has(self::$SESSION_VISITOR_NAME)) {
            $visitorName = $this->get('session')->get(self::$SESSION_VISITOR_NAME);
        } else {
            $this->get('session')->set(self::$SESSION_VISITOR_NAME, $visitorName);
        }

        // Check if the visitor is already saved.
        $visitor = $emi->getRepository(NodeVisitor::class)->findOneBy(['name' => $visitorName]);

        var_dump($visitor);
        die();

        /* if (!$visitor) {
            // Resiter the new visitor.
            $visitor = new NodeVisitor($visitorName, 21);

            $emi->persist($visitor);
            $emi->flush();
        } */

        return $visitor;
    }
}
