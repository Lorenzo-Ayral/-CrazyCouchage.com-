<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Logement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $catOne = new Category();
        $catOne->setLabel('Week-end');

        $catTwo = new Category();
        $catTwo->setLabel('Grandes Vacances');

        $catThree = new Category();
        $catThree->setLabel('Journée');

        $manager->persist($catOne);
        $manager->persist($catTwo);
        $manager->persist($catThree);

        $logementOne = new Logement();
        $logementOne->setType('Appartement');
        $manager->persist($logementOne);

        $logementTwo = new Logement();
        $logementTwo->setType('Chez l\'habitant');
        $manager->persist($logementTwo);
        
        $logementThree = new Logement();
        $logementThree->setType('Maison de campagne');
        $manager->persist($logementThree);

        $logementFour = new Logement();
        $logementFour->setType('Chalet à la montagne');
        $manager->persist($logementFour);

        $manager->flush();
    }
}
