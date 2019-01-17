<?php

namespace App\Controller\Api;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
    /**
     * @Route("/api/properties", methods={ "GET" })
     */
    public function listProperty() {
        $repository = $this->getDoctrine()->getRepository(Property::class);

        $properties = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($properties, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/properties", methods={ "POST" })
     */
    public function createProperty() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/properties/{propertyId}", methods={ "GET" }, requirements={"propertyId"="\d+"})
     */
    public function readProperty($propertyId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/properties/{propertyId}", methods={ "PUT" }, requirements={"propertyId"="\d+"})
     */
    public function updateProperty($propertyId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/properties/{propertyId}", methods={ "DELETE" }, requirements={"propertyId"="\d+"})
     */
    public function deleteProperty($propertyId) {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Property::class);
        // Find the Property with id $propertyId.
        $property = $repository->find($propertyId);

        // Remove the Property.
        $manager->remove($property);
        $manager->flush();

        return new JsonResponse(array("message" => "Successfully deleted."));
    }
}
