<?php
namespace Core\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Core\Mapper\AbstractMapper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Initialize serviceManager
 *
 * @author V.Leontiev
 */
abstract class AbstractForm extends Form implements InputFilterInterface, ServiceLocatorAwareInterface
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
     * @var ServiceLocatorInterface
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
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Core\Mapper\AbstractMapper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
