<?php
namespace Core\Mapper;

use Core\Mapper\MapperInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * Description of AbstractMapper
 *
 * @author V.Leontiev
 */
abstract class AbstractMapper implements MapperInterface, ServiceLocatorAwareInterface
{

    /**
     * Service locator object
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceLocator;

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
     * Execute action for entity
     *
     * @param entity $entity            
     * @return entity
     */
    protected function persist($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        
        return $entity;
    }
}
