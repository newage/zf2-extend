<?php

namespace User\Factory;

use User\Entity\User;
use User\Form\LoginForm;
use User\Form\UserForm;
use User\Service\LoginService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Initialize and setup LoginService
 * @package User\Factory
 */
class LoginServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new LoginService();
        $service->setServiceLocator($serviceLocator);

        $form = new UserForm('login');
        $form->bind(new User());
        $service->setForm($form);

        return $service;
    }
}
