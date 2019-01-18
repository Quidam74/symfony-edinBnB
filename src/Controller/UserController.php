<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="profile")
     * @param UserRepository $userRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserRepository $userRepository,$id)
    {
        $user = $userRepository->find($id);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
        ]);
    }
}
