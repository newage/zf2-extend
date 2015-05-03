<?php

namespace Behat\Context\User;

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use User\Entity\User;

/**
 * Features context.
 */
class FeatureContext extends RawMinkContext
{

    /**
     * @var \Zend\Mvc\Application
     */
    private static $zendApp;

    /**
     * @BeforeSuite
     */
//    public static function initZendFramework()
//    {
//        if (null === self::$zendApp) {
//            $path = realpath(__DIR__ . '/../../../../../config/application.config.php');
//            self::$zendApp = \Zend\Mvc\Application::init(require $path);
//        }
//    }

    /**
     * @return \Zend\Mvc\Application
     */
    public function getApplication()
    {
        return self::$zendApp;
    }

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->getApplication()->getServiceManager();
    }

    /**
     * @Given /^there is new user$/
     */
    public function thereIsNewUser(TableNode $table)
    {
        $data = $table->getRow(1);
        $userEntity = new User();
        $userEntity->setIdentifier($data[0]);
        $userEntity->setPassword($data[1]);

        /* @var $roleModel \User\Model\RoleModel */
        $roleModel = $this->getServiceManager()->get('RoleModel');
        $roleEntity = $roleModel->getDefaultRole();

        /* @var $userModel \User\Model\UserModel */
        $userModel = $this->getServiceManager()->get('UserModel');
        $userModel->create($userEntity, $roleEntity);
    }
}
