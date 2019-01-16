<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:40
 */

namespace App\DataFixtures;


use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adresse = new Address();

        $adresse->setPostCode("74960");
        $adresse->setCountry("France");
        $adresse->setCity("Mégevette");
        $adresse->setComplement("118 Impasse du grand pre");
        $manager->persist($adresse);
        $manager->flush();
    }

}