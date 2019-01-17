<?php

namespace App\Controller\Api;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends AbstractController
{
    /**
     * @Route("/api/equipments", methods={ "GET" })
     */
    public function listEquipment() {
        $repository = $this->getDoctrine()->getRepository(Equipment::class);

        $equipments = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($equipments, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/equipments", methods={ "POST" })
     */
    public function createEquipment(Request $request) {
        $equipment = new Equipment();

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        // Create form without csrf protection.
        $form = $this->createForm(EquipmentType::class, $equipment, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Equipment.
            $manager->persist($equipment);
            $manager->flush();

            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($equipment, 'json');

            // Return the created Equipment.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "GET" }, requirements={"equipmentId"="\d+"})
     */
    public function readEquipment($equipmentId) {
            $repository = $this->getDoctrine()->getRepository(Equipment::class);

            // Find the Equipment with id $equipmentId.
            $equipment = $repository->find($equipmentId);

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($equipment, 'json');

            return new Response($reports);
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "PUT" }, requirements={"equipmentId"="\d+"})
     */
    public function updateEquipment(Request $request , $equipmentId) {
        $repository = $this->getDoctrine()->getRepository(Equipment::class);
        // Find the Equipment with id $equipmentId.
        $equipment = $repository->find($equipmentId);

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(EquipmentType::class, $equipment, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        // Create form without csrf protection.
        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Equipment.
            $manager->persist($equipment);
            $manager->flush();

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($equipment, 'json');

            // Return the created Equipment.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "DELETE" }, requirements={"equipmentId"="\d+"})
     */
    public function deleteEquipment($equipmentId) {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Equipment::class);
        // Find the Equipment with id $equipmentId.
        $equipment = $repository->find($equipmentId);

        // Remove the Equipment.
        $manager->remove($equipment);
        $manager->flush();

        return new JsonResponse(array("message" => "Successfully deleted."));
    }
}
