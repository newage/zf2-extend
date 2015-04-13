<?php

namespace User\Factory;

use User\Entity\User;
use User\Form\ForgotForm;
use User\Service\ForgotService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Create forgot service
 * @package User\Factory
 */
class ForgotServiceFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return ForgotService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ForgotService();
        $service->setServiceLocator($serviceLocator);

        $form = new ForgotForm();
        $form->bind(new User());
        $service->setForm($form);

        /* Send email with instructions for restore password */
        $service->getEventManager()->attach(
            'forgot',
            [$serviceLocator->get('SendEmailEvent'), 'registration']
        );

        return $service;
    }
}
