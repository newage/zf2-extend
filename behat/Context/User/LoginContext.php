<?php

namespace BDD\Context\User;

use Core\Behat\ExtendContext;

/**
 * Features context.
 */
class LoginContext extends ExtendContext
{


//    /**
//     * @BeforeSuite
//     */
//    public static function thereIsNewUser()
//    {
//        $application = self::initZendFramework();
//        $serviceManager = $application->getServiceManager();
//
//        $userEntity = new User();
//        $userEntity->setIdentifier('behat@behat.test');
//        $userEntity->setPassword('behat');
//
//        /* @var $roleModel \User\Model\RoleModel */
//        $roleModel = $serviceManager->get('RoleModel');
//        $roleEntity = $roleModel->getDefaultRole();
//
//        /* @var $userModel \User\Model\UserModel */
//        $userModel = $serviceManager->get('UserModel');
//        $userModel->create($userEntity, $roleEntity);
//
//        self::$userId = $userEntity->getId();
//    }
//
//    /**
//     * @AfterSuite
//     */
//    public static function removeCreatedUser()
//    {
//        $application = self::initZendFramework();
//        $serviceManager = $application->getServiceManager();
//
//        /* @var $userModel \User\Model\UserModel */
//        $userModel = $serviceManager->get('UserModel');
//        $userModel->delete(self::$userId);
//    }
}
