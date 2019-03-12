<?php

namespace App\Controller\Api;

use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends ApiRESTController
{
    /**
     * @Route("/api/properties", methods={ "GET" })
     */
    public function listProperty()
    {
        return $this->list(Property::class, ['property']);
    }

    /**
     * @Route("/api/properties", methods={ "POST" })
     */
    public function createProperty(Request $request)
    {
        return $this->create($request, PropertyType::class, Property::class, ['property']);
    }

    /**
     * @Route("/api/property/{propertyId}", methods={ "GET" }, requirements={"propertyId"="\d+"})
     */
    public function readProperty($propertyId)
    {
        return $this->read(Property::class, $propertyId, ['property']);
    }

    /**
     * @Route("/api/property/{propertyId}", methods={ "PUT" }, requirements={"propertyId"="\d+"})
     */
    public function updateProperty(Request $request, $propertyId)
    {
        return $this->update($request, PropertyType::class, Property::class, $propertyId, ['property']);
    }

    /**
     * @Route("/api/property/{propertyId}", methods={ "DELETE" }, requirements={"propertyId"="\d+"})
     */
    public function deleteProperty($propertyId)
    {
        return $this->delete(Property::class, $propertyId);
    }
}
