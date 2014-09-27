<?php

namespace User\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class UserModel
 * @package User\Factory
 */
class UserModelFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $model = new \User\Model\UserModel();
        $model->setServiceLocator($serviceLocator);
        $model->setForm($serviceLocator->get('RegistrationForm'));
        $model->setMapper($serviceLocator->get('UserMapper'));
        return $model;
    }
}
