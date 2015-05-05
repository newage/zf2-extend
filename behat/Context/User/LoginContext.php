<?php

namespace BDD\Context\User;

use Behat\Behat\Context\SnippetAcceptingContext;
use Core\Behat\ExtendContext;

/**
 * Features context.
 */
class LoginContext extends ExtendContext implements SnippetAcceptingContext
{

//    /**
//     * @Given I am registering as new user
//     */
//    public function iAmRegisteringAsNewUser(TableNode $table)
//    {
//        $application = self::initZendFramework();
//        $serviceManager = $application->getServiceManager();
//
//        $row = $table->getHash()[0];
//
//        $userEntity = new User();
//        $userEntity->setIdentifier($row['identifier']);
//        $userEntity->setPassword($row['password']);
//
//        /* @var $roleModel \User\Model\RoleModel */
//        $roleModel = $serviceManager->get('RoleModel');
//        $roleEntity = $roleModel->getDefaultRole();
//
//        /* @var $userModel \User\Model\UserModel */
//        $userModel = $serviceManager->get('UserModel');
//        $userModel->create($userEntity, $roleEntity);
//    }
}
