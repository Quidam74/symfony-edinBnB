<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    /**
     * @Route("/", name="listing")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Property::class);
        $PlacesToSleep = $repository->findAll();


        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
            'listingData' => $PlacesToSleep,
        ]);
    }
}
