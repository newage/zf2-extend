<?php
namespace User\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use User\Entity\User;

class Users implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        /* Create admin */
        $admin = new User();
        $admin->setEmail('admin@admin.admin');
        $admin->setSalt(md5(time()));
        $admin->setPassword(md5('123qwe' . $admin->getSalt() . User::SECRET_KEY));
        
        $roleAdmin = $manager->getRepository('User\Entity\Role')->findOneBy(array(
            'name' => 'admin'
        ));
        $admin->setRole($roleAdmin);
        $admin->setCreatedAt();
        $admin->setStatus(User::STATUS_ENABLE);
        
        /* Create user */
        $user = new User();
        $user->setEmail('user@user.user');
        $user->setSalt(md5(time()));
        $user->setPassword(md5('123qwe' . $admin->getSalt() . User::SECRET_KEY));
        
        $roleUser = $manager->getRepository('User\Entity\Role')->findOneBy(array(
            'name' => 'user'
        ));
        $user->setRole($roleUser);
        $user->setCreatedAt();
        $user->setStatus(User::STATUS_ENABLE);
        
        $manager->persist($admin);
        $manager->persist($user);
        $manager->flush();
    }
}