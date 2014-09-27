<?php

namespace User\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RoleModelFactory
 * @package User\Factory
 */
class RoleModelFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $model = new \User\Model\RoleModel();
        $model->setServiceLocator($serviceLocator);
        $model->setForm($serviceLocator->get('RoleForm'));
        $model->setMapper($serviceLocator->get('RoleMapper'));
        return $model;
    }
}
