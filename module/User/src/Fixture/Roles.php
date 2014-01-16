<?php
namespace User\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use User\Entity\Role;

class Roles implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $roleGuest = new Role();
        $roleGuest->setName('guest');
        $roleGuest->setParentId(1);
        
        $roleUser = new Role();
        $roleUser->setName('user');
        $roleUser->setParentId(1);
        
        $roleAdmin = new Role();
        $roleAdmin->setName('admin');
        $roleAdmin->setParentId(3);
        
        $manager->persist($roleGuest);
        $manager->persist($roleUser);
        $manager->persist($roleAdmin);
        $manager->flush();
    }
}