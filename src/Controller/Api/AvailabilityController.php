<?php

namespace App\Controller\Api;

use App\Entity\Availability;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AvailabilityController extends AbstractController
{
    /**
     * @Route("/api/availabilities", methods={ "GET" })
     */
    public function listAvailability() {
        $repository = $this->getDoctrine()->getRepository(Availability::class);

        $availabilities = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($availabilities, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/availabilities", methods={ "POST" })
     */
    public function createAvailability() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "GET" }, requirements={"availabilityId"="\d+"})
     */
    public function readAvailability($availabilityId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "PUT" }, requirements={"availabilityId"="\d+"})
     */
    public function updateAvailability($availabilityId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "DELETE" }, requirements={"availabilityId"="\d+"})
     */
    public function deleteAvailability($availabilityId) {
        return "Not implemented yet.";
    }
}
