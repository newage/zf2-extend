<?php

namespace Core\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * Initialize serviceManager
 *
 * @author V.Leontiev
 */
abstract class AbstractForm extends Form implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function __construct()
    {
        parent::__construct('post');
        $this->init();
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

}
