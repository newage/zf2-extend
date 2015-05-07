<?php

namespace BDD\Context\User;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Core\Behat\ExtendContext;

/**
 * Features context.
 */
class LoginContext extends ExtendContext implements SnippetAcceptingContext
{

    /**
     * @Given /^There are following roles:$/
     */
    public function thereAreRoles(TableNode $table)
    {
        throw new PendingException();
    }


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
