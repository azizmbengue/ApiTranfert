<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AzizFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $prof_supadmin = new Profile();
        $prof_supadmin->setLibelle("SUPER_ADMIN");
        $manager->persist($prof_supadmin);

        $prof_admin = new Profile();
        $prof_admin->setLibelle("ADMIN");
        $manager->persist($prof_admin);

        $prof_caissier = new Profile();
        $prof_caissier->setLibelle("CAISSIER");
        $manager->persist($prof_caissier);

        $manager->flush();

        $this->addReference('super_admin', $prof_supadmin);
        $this->addReference('admin', $prof_admin);
        $this->addReference('super_caissier', $prof_caissier);

        $ref_supadmin = $this->getReference('super_admin');

        $user = new User();

        $user->setUsername("mbengue");
        $user->setPassword($this->encoder->encodePassword($user, 'aziztara'));
        $user->setIsActive(true);
        $user->setProfile($ref_supadmin);
        $user->setRoles(["SUPER_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
    }
}
