<?php

namespace App\Controller\Api;

use App\Entity\Availability;
use App\Form\AvailabilityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AvailabilityController extends AbstractController
{
    /**
     * @Route("/api/availabilities", methods={ "GET" })
     */
    public function listAvailability()
    {
        $repository = $this->getDoctrine()->getRepository(Availability::class);

        $availabilities = $repository->findAll();

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($availabilities, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/availabilities", methods={ "POST" })
     */
    public function createAvailability(Request $request)
    {
        $availability = new Availability();

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        // Create form without csrf protection.
        $form = $this->createForm(AvailabilityType::class, $availability, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Availability.
            $manager->persist($availability);
            $manager->flush();

            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($availability, 'json');

            // Return the created Availability.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "GET" }, requirements={"availabilityId"="\d+"})
     */
    public function readAvailability($availabilityId)
    {
        $repository = $this->getDoctrine()->getRepository(Availability::class);

        // Find the Availability with id $availabilityId.
        $availability = $repository->find($availabilityId);

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($availability, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "PUT" }, requirements={"availabilityId"="\d+"})
     */
    public function updateAvailability(Request $request, $availabilityId)
    {
        $repository = $this->getDoctrine()->getRepository(Availability::class);
        // Find the Availability with id $availabilityId.
        $availability = $repository->find($availabilityId);

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(AvailabilityType::class, $availability, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        // Create form without csrf protection.
        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Availability.
            $manager->persist($availability);
            $manager->flush();

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($availability, 'json');

            // Return the created Availability.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "DELETE" }, requirements={"availabilityId"="\d+"})
     */
    public function deleteAvailability($availabilityId)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Availability::class);
        // Find the Availability with id $availabilityId.
        $availability = $repository->find($availabilityId);

        // Remove the Availability.
        $manager->remove($availability);
        $manager->flush();

        return new JsonResponse(array("message" => "Successfully deleted."));
    }
}
