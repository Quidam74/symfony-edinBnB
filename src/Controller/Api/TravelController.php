<?php

namespace App\Controller\Api;

use App\Entity\Travel;
use App\Form\TravelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TravelController extends ApiRESTController
{
    /**
     * @Route("/api/travels", methods={ "GET" })
     */
    public function listTravel()
    {
        return $this->list(Travel::class, ['travel']);
    }

    /**
     * @Route("/api/travels", methods={ "POST" })
     */
    public function createTravel(Request $request)
    {
        return $this->create($request, TravelType::class, Travel::class, ['travel']);
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "GET" }, requirements={"travelId"="\d+"})
     */
    public function readTravel($travelId)
    {
        return $this->read(Travel::class, $travelId, ['travel']);
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "PUT" }, requirements={"travelId"="\d+"})
     */
    public function updateTravel(request $request, $travelId)
    {
        return $this->update($request, TravelType::class, Travel::class, $travelId, ['travel']);
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "DELETE" }, requirements={"travelId"="\d+"})
     */
    public function deleteTravel($travelId)
    {
        return $this->delete(Travel::class, $travelId);
    }
}
