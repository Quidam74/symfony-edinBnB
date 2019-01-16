<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:04
 */

namespace App\DataFixtures;

use App\Entity\Bien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BienFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $bien = new Bien();

         $bien->setNbLit(4);
         $bien->setDescription("Freshly decorated spacious home with garden.");
         $bien->setNbChambre(2);
         $bien->setNbPersonne(5);
         $bien->setNbSalleDeBain(1);
         $bien->setPrix(58);
         $manager->persist($bien);

        $manager->flush();
    }
}