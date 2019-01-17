<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 16/01/2019
 * Time: 13:41
 */

namespace App\DataFixtures;


use App\Entity\Address;
use App\Entity\Availability;
use App\Entity\User;
use App\Entity\Property;
use App\Entity\Day;
use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AllFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $adresseOwner = new Address();

        $adresseOwner->setPostCode("74960");
        $adresseOwner->setCountry("France");
        $adresseOwner->setCity("Mégevette");
        $adresseOwner->setComplement("118 Impasse du grand pre");
        $manager->persist($adresseOwner);

        $adresseTraveler = new Address();

        $adresseTraveler->setPostCode("00000");
        $adresseTraveler->setCountry("Nerverland");
        $adresseTraveler->setCity("noWhere");
        $adresseTraveler->setComplement("none");
        $manager->persist($adresseTraveler);

        $adresseProperty = new Address();

        $adresseProperty->setPostCode("74000");
        $adresseProperty->setCountry("France");
        $adresseProperty->setCity("Annecy");
        $adresseProperty->setComplement("123 rue de l'arc-en-ciel");
        $manager->persist($adresseProperty);

        $owner = new User();
        $owner->setFirstName("paul");
        $owner->setLastName("durant");
        $owner->setEmail("paul.durant@gmail.com");
        $owner->setDateOfBirth(new \DateTime('1995-01-01'));
        $owner->setIsTraveler(false);
        $owner->setBankingReference("refBankOwner");
        $owner->setHashPassword("ownerPassword");
        $owner->setAddress($adresseOwner);


        $traveler = new User();
        $traveler->setFirstName("marco");
        $traveler->setLastName("polo");
        $traveler->setEmail("marco.polo@gmail.com");
        $traveler->setDateOfBirth(new \DateTime('1254-09-15'));
        $traveler->setIsTraveler(true);
        $traveler->setBankingReference("refBankTraveler");
        $traveler->setHashPassword("travelerPassword");
        $traveler->setAddress($adresseTraveler);

        $manager->persist($owner);
        $manager->persist($traveler);


        $equipement1 = new Equipment();
        $equipement2 = new Equipment();
        $equipement3 = new Equipment();

        $equipement1->setDescription("wi-Fi");
        $manager->persist($equipement1);

        $manager->flush();
        $equipement2->setDescription("Cheminée");
        $manager->persist($equipement2);

        $manager->flush();
        $equipement3->setDescription("Sèche-linge");
        $manager->persist($equipement3);


        $bien = new Property();

        $bien->setBedCount(4);
        $bien->setDescription("Freshly decorated spacious home with garden.");
        $bien->setBedRoomCount(2);
        $bien->setPersonCount(5);
        $bien->setBathRoomCount(1);
        $bien->setPrice(58);
        $bien->setUser($owner);
        $bien->addEquipment($equipement1);
        $bien->addEquipment($equipement2);
        $bien->setAddress($adresseProperty);


        $manager->persist($bien);

        $day = new \DateTime("01-01-2019");
        $jour = null;
        for ($i = 1; $i <= 365; $i++) {
            $day->modify("+1 day");
            $jour = new Day();
            $jour->setDay($day);
            $manager->persist($jour);
            $manager->flush();
        }

        $availability = new Availability();

        $availability->setDay($jour);
        $availability->setIsAvailable(true);
        $availability->setProperty($bien);

        $manager->persist($availability);

        $manager->flush();
    }

}