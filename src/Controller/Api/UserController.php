<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/users", methods={ "GET" })
     */
    public function listUsers() {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($users, 'json');

        return new Response($reports);
    }

    /**
     * @Route("/api/users", methods={ "POST" })
     */
    public function createUser() {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/user/{userId}", methods={ "GET" }, requirements={"userId"="\d+"})
     */
    public function readUser($userId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/user/{userId}", methods={ "PUT" }, requirements={"userId"="\d+"})
     */
    public function updateUser($userId) {
        return "Not implemented yet.";
    }

    /**
     * @Route("/api/user/{userId}", methods={ "DELETE" }, requirements={"userId"="\d+"})
     */
    public function deleteUser($userId) {
        return "Not implemented yet.";
    }
}
