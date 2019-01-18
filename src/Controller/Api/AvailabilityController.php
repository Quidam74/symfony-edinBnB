<?php

namespace App\Controller\Api;

use App\Entity\Availability;
use App\Form\AvailabilityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AvailabilityController extends ApiRESTController
{
    /**
     * @Route("/api/availabilities", methods={ "GET" })
     */
    public function listAvailability()
    {
        return $this->list(Availability::class, ['availability']);
    }

    /**
     * @Route("/api/availabilities", methods={ "POST" })
     */
    public function createAvailability(Request $request)
    {
        return $this->create($request, AvailabilityType::class, Availability::class, ['availability']);
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "GET" }, requirements={"availabilityId"="\d+"})
     */
    public function readAvailability($availabilityId)
    {
        return $this->read(Availability::class, $availabilityId, ['availability']);
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "PUT" }, requirements={"availabilityId"="\d+"})
     */
    public function updateAvailability(Request $request, $availabilityId)
    {
        return $this->update($request, AvailabilityType::class, Availability::class, $availabilityId, ['availability']);
    }

    /**
     * @Route("/api/availability/{availabilityId}", methods={ "DELETE" }, requirements={"availabilityId"="\d+"})
     */
    public function deleteAvailability($availabilityId)
    {
        return $this->delete(Availability::class, $availabilityId);
    }
}
