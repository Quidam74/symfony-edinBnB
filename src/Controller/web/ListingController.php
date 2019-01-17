<?php

namespace App\Controller\web;

use App\Entity\Picture;
use App\Entity\Property;
use App\Repository\PictureRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    /**
     * @Route("/", name="listing")
     */
    public function index(PropertyRepository $propertyRepository)
    {
        $properties = $propertyRepository->findAll();

        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
            'properties' => $properties,
        ]);
    }
}
