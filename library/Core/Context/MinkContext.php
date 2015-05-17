<?php

namespace Core\Context;

use Behat\MinkExtension\Context\MinkContext as Mink;
use Zend\Mvc\Application;

/**
 * Initialize Zend Framework
 * @package Core\Context
 */
class MinkContext extends Mink
{

    /**
     * @var Application
     */
    private static $zendApp;

    /**
     * @BeforeSuite
     */
    public static function initZendFramework()
    {
        if (null === self::$zendApp) {
            $path = realpath(__DIR__ . '/../../../../../config/application.config.php');
            self::$zendApp = Application::init(require $path);
        }
    }

    /**
     * Get application
     * @return Application
     */
    public function getApplication()
    {
        return self::$zendApp;
    }

    /**
     * Get service Manager
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return self::$zendApp->getServiceManager();
    }
}
