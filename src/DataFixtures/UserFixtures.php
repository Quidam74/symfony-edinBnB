<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 13:24
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $owner = new User();
        $owner->setFirstName("paul");
        $owner->setLastName("durant");
        $owner->setEmail("paul.durant@gmail.com");
        $owner->setDateOfBirth(new \DateTime('1995-01-01'));
        $owner->setIsTraveler(false);
        $owner->setBankingReference("refBankOwner");
        $owner->setHashPassword("ownerPassword");

        $traveler = new User();
        $traveler->setFirstName("marco");
        $traveler->setLastName("polo");
        $traveler->setEmail("marco.polo@gmail.com");
        $traveler->setDateOfBirth(new \DateTime('1254-09-15'));
        $traveler->setIsTraveler(true);
        $traveler->setBankingReference("refBankTraveler");
        $traveler->setHashPassword("travelerPassword");



        $manager->persist($owner);
        $manager->persist($traveler);
        $manager->flush();
    }

}