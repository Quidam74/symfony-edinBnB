<?php

namespace App\Controller\Api;

use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends ApiRESTController
{
    /**
     * @Route("/api/addresses", methods={ "GET" })
     */
    public function listAddress()
    {
        return $this->list(Address::class);
    }

    /**
     * @Route("/api/addresses", methods={ "POST" })
     */
    public function createAddress(Request $request)
    {
        return $this->create($request, AddressType::class, Address::class);
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "GET" }, requirements={"addressId"="\d+"})
     */
    public function readAddress($addressId)
    {
        return $this->read(Address::class, $addressId);
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "PUT" }, requirements={"addressId"="\d+"})
     */
    public function updateAddress(Request $request, $addressId)
    {
        return $this->update($request, AddressType::class, Address::class, $addressId);
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "DELETE" }, requirements={"addressId"="\d+"})
     */
    public function deleteAddress($addressId)
    {
        return $this->delete(Address::class, $addressId);
    }
}
