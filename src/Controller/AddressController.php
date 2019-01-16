<?php

namespace App\Controller;

use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    /**
     * @Route("/api/addresses", methods={ "GET" })
     */
    public function listAddress() {
        $repository = $this->getDoctrine()->getRepository(Address::class);

        $addresses = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($addresses, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/addresses", methods={ "POST" })
     */
    public function createAddress() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "GET" }, requirements={"addressId"="\d+"})
     */
    public function readAddress($addressId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "PUT" }, requirements={"addressId"="\d+"})
     */
    public function updateAddress($addressId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "DELETE" }, requirements={"addressId"="\d+"})
     */
    public function deleteAddress($addressId) {
        return "Not implemented yet.";
    }
}
