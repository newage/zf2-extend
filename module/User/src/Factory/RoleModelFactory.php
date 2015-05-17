<?php

namespace User\Factory;

use User\Model\RoleModel;
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
        $model = new RoleModel();
        /* @var $mapper \User\Mapper\RoleMapper */
        $mapper = $serviceLocator->get('RoleMapper');
        $model->setMapper($mapper);
        return $model;
    }
}
