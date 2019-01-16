<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/api/properties/{propertiesId}", methods={ "GET" }, requirements={"propertiesId"="\d+"})
     */
    public function readProperty($propertiesId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/properties/{propertiesId}", methods={ "PUT" }, requirements={"propertiesId"="\d+"})
     */
    public function updateProperty($propertiesId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/properties/{propertiesId}", methods={ "DELETE" }, requirements={"propertiesId"="\d+"})
     */
    public function deleteProperty($propertiesId) {
        return "Not implemented yet.";
    }
}
