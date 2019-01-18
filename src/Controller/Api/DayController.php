<?php

namespace App\Controller\Api;

use App\Entity\Day;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends ApiRESTController
{

    /**
     * @Route("/api/days", methods={ "GET" })
     */
    public function listDay()
    {
        return $this->list(Day::class);
    }

    /**
     * @Route("/api/day/{dayId}", methods={ "GET" }, requirements={"dayId"="\d+"})
     */
    public function readDay($dayId)
    {
        return $this->read(Day::class, $dayId);
    }
}
