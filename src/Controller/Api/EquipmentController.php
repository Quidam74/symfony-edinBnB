<?php

namespace App\Controller\Api;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends ApiRESTController
{
    /**
     * @Route("/api/equipments", methods={ "GET" })
     */
    public function listEquipment()
    {
        return $this->list(Equipment::class);
    }

    /**
     * @Route("/api/equipments", methods={ "POST" })
     */
    public function createEquipment(Request $request)
    {
        return $this->create($request, EquipmentType::class, Equipment::class);
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "GET" }, requirements={"equipmentId"="\d+"})
     */
    public function readEquipment($equipmentId)
    {
        return $this->read(Equipment::class, $equipmentId);
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "PUT" }, requirements={"equipmentId"="\d+"})
     */
    public function updateEquipment(Request $request, $equipmentId)
    {
        return $this->update($request, EquipmentType::class, Equipment::class, $equipmentId);
    }

    /**
     * @Route("/api/equipment/{equipmentId}", methods={ "DELETE" }, requirements={"equipmentId"="\d+"})
     */
    public function deleteEquipment($equipmentId)
    {
        return $this->delete(Equipment::class, $equipmentId);
    }
}
