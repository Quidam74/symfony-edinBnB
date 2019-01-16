<?php

namespace App\Controller;

use App\Entity\Availability;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/api/availability/{availabilityId}", methods={ "GET" }, requirements={"addressId"="\d+"})
     */
    public function readAvailability($addressId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "PUT" }, requirements={"addressId"="\d+"})
     */
    public function updateAvailability($addressId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "DELETE" }, requirements={"addressId"="\d+"})
     */
    public function deleteAvailability($addressId) {
        return "Not implemented yet.";
    }
}
