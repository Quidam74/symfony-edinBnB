<?php

namespace App\Controller\Api;

use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
        $repository = $this->getDoctrine()->getRepository(Property::class);

        // Find the Property with id $propertyId.
        $property = $repository->find($propertyId);

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($property, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/properties/{propertyId}", methods={ "PUT" }, requirements={"propertyId"="\d+"})
     */
    public function updateProperty(Request $request, $propertyId) {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        // Find the Property with id $propertyId.
        $property = $repository->find($propertyId);

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(PropertyType::class, $property, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        // Create form without csrf protection.
        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Property.
            $manager->persist($property);
            $manager->flush();

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($property, 'json');

            // Return the created Property.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
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
