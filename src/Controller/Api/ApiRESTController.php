<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRESTController extends AbstractController
{
    public function list($class, array $groups = [])
    {
        $repository = $this->getDoctrine()->getRepository($class);
        $list = $repository->findAll();

        $reports = $this->serializeObject($list, $groups);
        return $this->buildJSONResponse($reports);
    }

    public function create(Request $request, $type, $class, array $groups = [])
    {
        // Create the new Object
        $object = new $class();

        return $this->handleObjectInForm($request, $type, $object, $groups);
    }

    public function read($class, int $id, array $groups = [])
    {
        $repository = $this->getDoctrine()->getRepository($class);

        // Find the Class with the id given.
        $object = $repository->find($id);

        $reports = $this->serializeObject($object, $groups);
        return $this->buildJSONResponse($reports);
    }

    public function update(Request $request, $type, $class, $id, array $groups = [])
    {
        $repository = $this->getDoctrine()->getRepository($class);
        // Find the Class with the id given.
        $object = $repository->find($id);

        return $this->handleObjectInForm($request, $type, $object, $groups);
    }

    public function delete($class, int $id)
    {
        $repository = $this->getDoctrine()->getRepository($class);
        // Find the Class with the id given.
        $object = $repository->find($id);

        // Remove the object.
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($object);
        $manager->flush();

        return $this->buildJSONResponse('{ "message": "Successfully deleted !" }');
    }

    private function handleObjectInForm(Request $request, $type, $object, array $groups = [])
    {
        // Create form without csrf protection.
        $form = $this->createForm($type, $object, array("csrf_protection" => false));

        // Get the data of request.
        $data = json_decode($request->getContent(), true);
        $form->handleRequest($request)
            ->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            // If the request is valide, save the new Object.
            $manager->persist($object);
            $manager->flush();

            $reports = $this->serializeObject($object, $groups);
            return $this->buildJSONResponse($reports);
        }

        // Else return an error.
        return $this->buildJSONResponse('{ "message": "Attribute(s) missing !" }', 400);
    }

    private function buildJSONResponse(string $jsonString, int $status = 200): Response
    {
        $response = new Response($jsonString);
        $response->headers->set("Content-Type", "application/json");
        $response->setStatusCode($status);

        return $response;
    }

    private function serializeObject($object, array $groups = []): string
    {
        $options = [];

        if (count($groups) > 0) {
            $options['groups'] = $groups;
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($object, 'json', $options);

        return $reports;
    }
}
