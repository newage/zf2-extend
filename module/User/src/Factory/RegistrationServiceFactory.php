<?php

namespace User\Factory;

use User\Service\RegistrationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RegistrationServiceFactory
 * @package User\Factory
 */
class RegistrationServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new RegistrationService();
        $service->setServiceManager($serviceLocator);

        /* Send registration email */
        $service->getEventManager()->attach(
            'registration',
            [$serviceLocator->get('SendEmailEvent'), 'registration']
        );

        return $service;
    }
}
