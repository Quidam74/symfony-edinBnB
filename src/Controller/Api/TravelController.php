<?php

namespace App\Controller\Api;

use App\Entity\Travel;
use App\Form\TravelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function createTravel(Request $request) {
        $travel = new Travel();

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        // Create form without csrf protection.
        $form = $this->createForm(TravelType::class, $travel, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Travel.
            $manager->persist($travel);
            $manager->flush();

            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($travel, 'json');

            // Return the created Travel.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "GET" }, requirements={"travelId"="\d+"})
     */
    public function readTravel($travelId) {
        $repository = $this->getDoctrine()->getRepository(Travel::class);

        // Find the Travel with id $travelId.
        $travel = $repository->find($travelId);

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($travel, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "PUT" }, requirements={"travelId"="\d+"})
     */
    public function updateTravel(request $request, $travelId) {
        $repository = $this->getDoctrine()->getRepository(Travel::class);
        // Find the Travel with id $travelId.
        $travel = $repository->find($travelId);

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(TravelType::class, $travel, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        // Create form without csrf protection.
        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Travel.
            $manager->persist($travel);
            $manager->flush();

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($travel, 'json');

            // Return the created Travel.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/travel/{travelId}", methods={ "DELETE" }, requirements={"travelId"="\d+"})
     */
    public function deleteTravel($travelId) {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Travel::class);
        // Find the Travel with id $travelId.
        $travel = $repository->find($travelId);

        // Remove the Travel.
        $manager->remove($travel);
        $manager->flush();

        return new JsonResponse(array("message" => "Successfully deleted."));
    }
}
