<?php

namespace App\Controller\web;

use App\Entity\Picture;
use App\Entity\Property;
use App\Repository\PictureRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/", name="properties")
     */
    public function returnListProperties(PropertyRepository $propertyRepository)
    {
        $properties = $propertyRepository->findAll();

        return $this->render('property/properties.html.twig', [
            'controller_name' => 'ListingController',
            'properties' => $properties,
        ]);
    }

    /**
     * @Route("/property", name="property")
     */
    public function index(PropertyRepository $propertyRepository)
    {
        $property = $propertyRepository->findOneBy(['id'=>'15']);

        return $this->render('property/property.html.twig', [
            'controller_name' => 'ListingController',
            'property' => $property,
        ]);
    }
}
