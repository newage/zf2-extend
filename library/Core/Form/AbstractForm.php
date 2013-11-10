<?php

namespace Core\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Core\Mapper\AbstractMapper;
use Core\Form\InputFilterInterface;

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
     * @var type 
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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('post');
        $this->init();
    }
    
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
    
    /**
     * Get mapper
     * @return AbstractMapper
     */
    public function getMapper()
    {
        if (!$this->mapper) {
            /** @TODO need exception */
        }
        return $this->mapper;
    }

    /**
     * Set mapper
     * @param \Core\Mapper\AbstractMapper $mapper
     * @return \Core\Form\AbstractForm
     */
    public function setMapper(AbstractMapper $mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }
    
    /**
     * Bind object if exist field with 'id' key
     * 
     * @param array|\ArrayAccess|Traversable $data
     * @return Form|FormInterface
     */
    public function setData($data)
    {
        if ($data instanceof Traversable) {
            $data = ArrayUtils::iteratorToArray($data);
        }
        if (isset($data['id'])) {
            $this->bind($this->getMapper()->find($data['id']));
        }
        return parent::setData($data);
    }

}
