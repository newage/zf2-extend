<?php

namespace Core\Behat;

use Behat\MinkExtension\Context\RawMinkContext;
use Zend\Mvc\Application;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Behat\Hook\Scope\AfterStepScope;

/**
 * Class ExtendContext
 * @package Core\Behat
 */
abstract class ExtendContext extends RawMinkContext
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
     * @return \Doctrine\ORM\EntityManager
     */
    public function getManager()
    {
        $application = self::initZendFramework();
        return $application->getServiceManager()->get('Doctrine\ORM\EntityManager');
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
}