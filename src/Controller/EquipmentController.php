<?php

namespace App\Controller;

use App\Entity\Equipment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function createEquipment() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "GET" }, requirements={"equipmentId"="\d+"})
     */
    public function readEquipment($equipmentId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "PUT" }, requirements={"equipmentId"="\d+"})
     */
    public function updateEquipment($equipmentId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "DELETE" }, requirements={"equipmentId"="\d+"})
     */
    public function deleteEquipment($equipmentId) {
        return "Not implemented yet.";
    }
}
