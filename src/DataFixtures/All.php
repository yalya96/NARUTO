<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class All extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user= new User();
        $user->setPrenom("El Hadji Yaya");
        $user->setNom("LY");
        $user->setTelephone("772652363");
        $user->setUsername("yalya");
        $user->setRoles(['ROLE_ALL']); 
        $user->setCNI("1234564879");
        $password = $this->encoder->encodePassword($user, 'welcome');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}
