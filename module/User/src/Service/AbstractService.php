<?php

namespace User\Service;

use Core\Service\Exception\RuntimeException;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * Class AbstractService
 * @package User\Service
 */
abstract class AbstractService implements ServiceManagerAwareInterface, EventManagerAwareInterface
{

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var EventManager
     */
    protected $eventManager;

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
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers([
            __CLASS__,
            get_called_class(),
        ]);
        $this->eventManager = $eventManager;
    }

    /**
     * Retrieve the event manager
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    /**
     * Get current form
     * @return Form
     */
    abstract public function getCurrentForm();
}
