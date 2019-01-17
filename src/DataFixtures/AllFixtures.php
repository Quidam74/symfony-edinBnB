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
use App\Entity\Travel;
use App\Entity\Picture;
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


        $property = new Property();

        $property->setBedCount(4);
        $property->setDescription("Freshly decorated spacious home with garden.");
        $property->setBedRoomCount(2);
        $property->setPersonCount(5);
        $property->setBathRoomCount(1);
        $property->setPrice(58);
        $property->setUser($owner);
        $property->addEquipment($equipement1);
        $property->addEquipment($equipement2);
        $property->setAddress($adresseProperty);

        $manager->persist($property);


        $picture1= new Picture();
        $picture2= new Picture();
        $picture3= new Picture();

        $picture1->setUrl("web/static/img/img1.jpg");
        $picture1->setProperty($property);
        $picture1->setDescription("image from my air BNB");

        $picture2->setUrl("web/static/img/img2.jpg");
        $picture2->setProperty($property);
        $picture2->setDescription("image from my air BNB");

        $picture3->setUrl("web/static/img/img3.jpg");
        $picture3->setProperty($property);
        $picture3->setDescription("image from my air BNB");

        $manager->persist($picture1);
        $manager->persist($picture2);
        $manager->persist($picture3);



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
        $availability->setProperty($property);

        $manager->persist($availability);

        $travel = new Travel();
        $travel->setProperty($property);
        $travel->setUser($traveler);
        $travel->addDay($jour);

        $manager->persist($travel);

        $manager->flush();
    }

}
