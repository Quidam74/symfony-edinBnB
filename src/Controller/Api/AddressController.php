<?php

namespace App\Controller\Api;

use App\Entity\Address;
use App\Form\AddressType;
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
    public function listAddress()
    {
        $repository = $this->getDoctrine()->getRepository(Address::class);

        $addresses = $repository->findAll();

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($addresses, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/addresses", methods={ "POST" })
     */
    public function createAddress(Request $request)
    {
        $address = new Address();

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        // Create form without csrf protection.
        $form = $this->createForm(AddressType::class, $address, array("csrf_protection" => false));
        $form->handleRequest($request)
            ->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Address.
            $manager->persist($address);
            $manager->flush();

            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($address, 'json');

            // Return the created Address.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "GET" }, requirements={"addressId"="\d+"})
     */
    public function readAddress($addressId)
    {
        $repository = $this->getDoctrine()->getRepository(Address::class);

        // Find the Address with id $addressId.
        $address = $repository->find($addressId);

        // Parse Object to jsonString.
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($address, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "PUT" }, requirements={"addressId"="\d+"})
     */
    public function updateAddress(Request $request, $addressId)
    {
        $repository = $this->getDoctrine()->getRepository(Address::class);
        // Find the Address with id $addressId.
        $address = $repository->find($addressId);

        $manager = $this->getDoctrine()->getManager();
        // Get the data of request.
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(AddressType::class, $address, array("csrf_protection" => false));
        $form->handleRequest($request)
             ->submit($data);

        // Create form without csrf protection.
        if ($form->isSubmitted() && $form->isValid()) {
            // If the request is valide, save the new Address.
            $manager->persist($address);
            $manager->flush();

            // Parse Object to jsonString.
            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($address, 'json');

            // Return the created Address.
            return new Response($reports);
        }

        // Else return an error.
        $response = new JsonResponse(array("message" => "Attribute(s) missing !"));
        $response->setStatusCode(400);
        return $response;
    }

    /**
     * @Route("/api/address/{addressId}", methods={ "DELETE" }, requirements={"addressId"="\d+"})
     */
    public function deleteAddress($addressId)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Address::class);
        // Find the Address with id $addressId.
        $address = $repository->find($addressId);

        // Remove the Address.
        $manager->remove($address);
        $manager->flush();

        return new JsonResponse(array("message" => "Successfully deleted."));
    }
}
