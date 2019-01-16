<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:04
 */

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BienFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $bien = new Property();

         $bien->setBedCount(4);
         $bien->setDescription("Freshly decorated spacious home with garden.");
         $bien->setBedRoomCount(2);
         $bien->setPersonCount(5);
         $bien->setBathRoomCount(1);
         $bien->setPrice(58);
         $manager->persist($bien);

        $manager->flush();
    }
}