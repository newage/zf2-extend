<?php
namespace Core\Mapper;

use Core\Mapper\MapperInterface;
use User\Entity\EntityInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Get service locator
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
     * @return AbstractMapper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Execute action for entity
     *
     * @param $entity
     * @return bool|int
     */
    abstract public function persist($entity);

}
