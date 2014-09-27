<?php
namespace Core\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Core\Form\AbstractForm;
use Core\Mapper\AbstractMapper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Model with business logic for user entity/form/mapper
 *
 * @author V.Leontiev
 */
abstract class AbstractModel implements ServiceLocatorAwareInterface
{

    /**
     * Service locator object
     * 
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Form object
     * 
     * @var AbstractForm
     */
    protected $form;

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
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Set current form
     *
     * @param AbstractForm $form            
     * @return AbstractModel
     */
    public function setForm(AbstractForm $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * Get current form
     * 
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Get mapper
     *
     * @return AbstractMapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * Set mapper
     *
     * @param AbstractMapper $userMapper            
     * @return AbstractModel
     */
    public function setMapper(AbstractMapper $mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }
}