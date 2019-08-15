<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Profils extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tableau=array('ADMINSYSTEME','CAISSIERSYSTEME','PRESTATAIRE','ADMIN','USER');
        for ($i=0; $i <count($tableau) ; $i++) { 
            $profil= new Profil();
            $profil->setLibeller($tableau[$i]);
            $manager->persist($profil);
        }

        $manager->flush();
    }
}
