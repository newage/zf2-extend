<?php

namespace BDD\Context\User;

use Behat\MinkExtension\Context\RawMinkContext;
use Zend\Mvc\Application;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Behat\Hook\Scope\AfterStepScope;

/**
 * Features context.
 */
class LoginContext extends RawMinkContext
{

    /**
     * @var Application
     */
    private static $zendApp;

    /**
     * @return Application
     */
    public static function initZendFramework()
    {
        if (null === self::$zendApp) {
            $path = realpath(__DIR__ . '/../../../config/application.config.php');
            self::$zendApp = Application::init(require $path);
        }
        return self::$zendApp;
    }

    /**
     * @AfterStep
     * @param AfterStepScope $scope
     */
    public function takeScreenShotAfterFailedStep(AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode()) {
            $driver = $this->getSession()->getDriver();
            if (!($driver instanceof Selenium2Driver)) {
                return;
            }
            file_put_contents('/tmp/test.png', $this->getSession()->getDriver()->getScreenshot());
        }
    }

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
