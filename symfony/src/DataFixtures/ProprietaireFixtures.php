<?php

namespace App\DataFixtures;

use App\Entity\Proprietaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProprietaireFixtures extends Fixture 
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $p1 = new Proprietaire();
        $p1->setName('Bob');
        $p1->setEmail('p1@gmail.com');
        $p1->setPassword($this->encoder->encodePassword($p1, 'demo'));
        $manager->persist($p1);

        $manager->flush();
    }
}