<?php

namespace User\Factory;

use DoctrineModule\Cache\ZendStorageCache;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DoctrineCacheFactory
 * @package User\Factory
 */
class DoctrineCacheFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ZendStorageCache($serviceLocator->get('cache.static.local'));
    }
}
