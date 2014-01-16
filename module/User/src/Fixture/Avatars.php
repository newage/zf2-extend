<?php
namespace User\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use User\Entity\Avatar;

class Avatars implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $userFour = $manager->getRepository('User\Entity\User')->findOneBy(array('email' => 'admin@admin.admin'));
        $userFive = $manager->getRepository('User\Entity\User')->findOneBy(array('email' => 'user@user.user'));
        
        $avatarOne = new Avatar();
        $avatarOne->setName('avatarOne');
        $avatarOne->setPath('http://');
        $avatarOne->setUser($userFour);
        $avatarOne->setCreatedAt();
        $avatarOne->setStatus(Avatar::STATUS_ENABLE);
        
        $avatarTwo = new Avatar();
        $avatarTwo->setName('avatarTwo');
        $avatarTwo->setPath('new:');
        $avatarTwo->setUser($userFour);
        $avatarTwo->setCreatedAt();
        $avatarTwo->setStatus(Avatar::STATUS_ENABLE);
        
        $avatarThree = new Avatar();
        $avatarThree->setName('avatarThree');
        $avatarThree->setPath('three:');
        $avatarThree->setUser($userFive);
        $avatarThree->setCreatedAt();
        $avatarThree->setStatus(Avatar::STATUS_ENABLE);
        
        $manager->persist($avatarOne);
        $manager->persist($avatarTwo);
        $manager->persist($avatarThree);
        $manager->flush();
    }
}