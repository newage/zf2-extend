<?php
namespace Core\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Core\Mapper\AbstractMapper;

/**
 * Initialize serviceManager
 *
 * @author V.Leontiev
 */
abstract class AbstractForm extends Form implements ServiceLocatorAwareInterface, InputFilterInterface
{

    /**
     * Input filters
     *
     * @var InputFilterInterface
     */
    protected $inputFilter;

    /**
     * Service locator object
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Mapper object
     *
     * @var AbstractMapper
     */
    protected $mapper;

    /**
     * Get service locatol
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Set service locator
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator            
     * @return \Core\Mapper\AbstractMapper
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
