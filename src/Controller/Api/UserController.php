<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends ApiRESTController
{
    /**
     * @Route("/api/users", methods={ "GET" })
     */
    public function listUsers()
    {
        return $this->list(User::class, ['user']);
    }

    /**
     * @Route("/api/users", methods={ "POST" })
     */
    public function createUser(Request $request)
    {
        return $this->create($request, UserType::class, User::class, ['user']);
    }

    /**
     * @Route("/api/user/{userId}", methods={ "GET" }, requirements={"userId"="\d+"})
     */
    public function readUser($userId)
    {
        return $this->read(User::class, $userId, ['user']);
    }

    /**
     * @Route("/api/user/{userId}", methods={ "PUT" }, requirements={"userId"="\d+"})
     */
    public function updateUser(Request $request, $userId)
    {
        return $this->update($request, UserType::class, User::class, $userId, ['user']);
    }

    /**
     * @Route("/api/user/{userId}", methods={ "DELETE" }, requirements={"userId"="\d+"})
     */
    public function deleteUser($userId)
    {
        return $this->delete(User::class, $userId);
    }
}
