<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 09:12
 */

namespace App\DataFixtures;


use App\Entity\Equipement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class EquipementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $equipement = new Equipement();

        $equipement->setLibelle("wi-Fi");
        $manager->persist($equipement);
        $equipement->setLibelle("Cheminée");
        $manager->persist($equipement);
        $equipement->setLibelle("Sèche-linge");
        $manager->persist($equipement);

        $manager->flush();
    }
}