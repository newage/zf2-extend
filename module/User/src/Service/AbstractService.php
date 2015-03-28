<?php

namespace User\Service;

use Core\Service\Exception\RuntimeException;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * Class AbstractService
 * @package User\Service
 */
abstract class AbstractService implements ServiceManagerAwareInterface
{

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Set service manager
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Get service manager
     * @return ServiceManager
     * @throws RuntimeException
     */
    public function getServiceManager()
    {
        if (!$this->serviceManager instanceof ServiceManager) {
            throw new RuntimeException('Service manager was not setup to service');
        }
        return $this->serviceManager;
    }

    /**
     * Get form
     * @param $name
     * @return array|null|object
     * @throws RuntimeException
     */
    public function getForm($name)
    {
        if ($this->getServiceManager()->has($name)) {
            $mapper = $this->getServiceManager()->get($name);
            if ($mapper instanceof Form) {
                return $mapper;
            }
        }
        return null;
    }

    /**
     * Get current form
     * @return Form
     */
    abstract public function getCurrentForm();
}
