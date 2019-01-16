<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:44
 */

namespace App\DataFixtures;

use App\Entity\Day;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class DayFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $day = new \DateTime("01-01-2019");

        for ($i = 1; $i <= 365; $i++) {
            $day->modify("+1 day");
            $jour = new Day();
            $jour->setDay($day);
            $manager->persist($jour);
            $manager->flush();
        }

    }
}