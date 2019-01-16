<?php

namespace App\Controller;

use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
    public function createAddress(Request $request) {
        $body = json_decode($request->getContent(), true);
        $manager = $this->getDoctrine()->getManager();

        // If no body is null, return error.
        if (!$body) {
            $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
            $response->setStatusCode(400);
            return $response;
        }

        try {
            // Create the new Address.
            $address = new Address();
            $address->setCity($body["city"]);
            $address->setComplement($body["complement"]);
            $address->setCountry($body["country"]);
            $address->setPostCode($body["postCode"]);

            $manager->persist($address);
            $manager->flush();

            // Parse the created object in JSON.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($address, 'json');

            return new Response($reports);
        } catch (\Exception $ex) {
            // Catch Exception for avoid request with messing attribute(s).
            $response = new JsonResponse(array("message" => "Attribute(s) missing !", "error" => $ex->getMessage()));
            $response->setStatusCode(400);
            return $response;
        }
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
