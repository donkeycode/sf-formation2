<?php

namespace App\DataFixtures;

use App\Entity\Bien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BienFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $b1 = new Bien();
        $b1->setLatitude(0);
        $b1->setLongitude(0);
        $b1->setLocalisation("2 rue de la poupee qui tousse");
        $b1->setProprietaire($this->getReference(ProprietaireFixtures::USER_BOB));

        $manager->persist($b1);

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            ProprietaireFixtures::class
        ];
    }
}