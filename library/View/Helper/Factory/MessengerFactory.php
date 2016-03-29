<?php

namespace Core\View\Helper\Factory;

use Core\View\Helper\Messenger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MessengerFactory
 * @package Core\View\Helper\Factory
 */
class MessengerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $helper = new Messenger();
        $controllerPluginManager = $serviceLocator->get('ControllerPluginManager');
        $messenger = $controllerPluginManager->get('messenger');
        $helper->setPluginMessenger($messenger);

        return $helper;
    }
}
