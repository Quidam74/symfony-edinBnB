<?php

namespace App\Controller\Api;

use App\Entity\Day;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractController
{

    /**
     * @Route("/api/days", methods={ "GET" })
     */
    public function listDay()
    {
        $repository = $this->getDoctrine()->getRepository(Day::class);

        $days = $repository->findAll();

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($days, 'json');

        $response = new Response($reports);
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @Route("/api/day/{dayId}", methods={ "GET" }, requirements={"dayId"="\d+"})
     */
    public function readDay($dayId)
    {
        $repository = $this->getDoctrine()->getRepository(Day::class);

        // Find the Address with id $dayId.
        $day = $repository->find($dayId);

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($day, 'json');

        $response = new Response($reports);
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }
}
