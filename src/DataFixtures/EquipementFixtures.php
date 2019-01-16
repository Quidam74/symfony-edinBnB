<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:12
 */

namespace App\DataFixtures;


use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class EquipementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $equipement = new Equipment();

        $equipement->setDescription("wi-Fi");
        $manager->persist($equipement);

        $manager->flush();
        $equipement->setDescription("Cheminée");
        $manager->persist($equipement);

        $manager->flush();
        $equipement->setDescription("Sèche-linge");
        $manager->persist($equipement);

        $manager->flush();
    }
}