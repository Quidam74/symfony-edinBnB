<?php

namespace App\Controller\Api;

use App\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TravelController extends AbstractController
{
    /**
     * @Route("/api/travels", methods={ "GET" })
     */
    public function listTravel() {
        $repository = $this->getDoctrine()->getRepository(Travel::class);

        $travel = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($travel, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/travels", methods={ "POST" })
     */
    public function createTravel() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "GET" }, requirements={"travelId"="\d+"})
     */
    public function readTravel($travelId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "PUT" }, requirements={"travelId"="\d+"})
     */
    public function updateTravel($travelId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "DELETE" }, requirements={"travelId"="\d+"})
     */
    public function deleteTravel($travelId) {
        return "Not implemented yet.";
    }
}
