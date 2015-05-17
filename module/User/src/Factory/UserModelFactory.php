<?php

namespace User\Factory;

use User\Model\UserModel;
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
        $model = new UserModel();
        /* @var $mapper \User\Mapper\UserMapper */
        $mapper = $serviceLocator->get('UserMapper');
        $model->setMapper($mapper);
        return $model;
    }
}
