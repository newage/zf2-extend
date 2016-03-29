<?php

namespace Core\Service;

use Core\Service\Exception\RuntimeException;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Class AbstractService
 * @package User\Service
 */
class AbstractService implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var EventManager
     */
    protected $eventManager;

    /**
     * @var Form
     */
    protected $form;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }


    /**
     * Get service manager
     * @return ServiceLocatorInterface
     * @throws RuntimeException
     */
    public function getServiceLocator()
    {
        if (!$this->serviceLocator instanceof ServiceLocatorInterface) {
            throw new RuntimeException('Service locator was not setup to service');
        }
        return $this->serviceLocator;
    }

    /**
     * Get form
     * @param $name
     * @return array|null|object
     * @throws RuntimeException
     */
    public function getService($name)
    {
        if ($this->getServiceLocator()->has($name)) {
            return $this->getServiceLocator()->get($name);
        } else {
            throw new RuntimeException('Service was not register: ' . $name);
        }
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
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Get current form
     * @return Form
     */
    public function getForm()
    {
        if (!$this->form instanceof Form) {
            throw new RuntimeException('Service do not have form: ' . __CLASS__);
        } else {
            return $this->form;
        }
    }
}
