<?php
namespace Core\Mapper;

use Core\Entity\EntityDoctrineManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Abstract mapper for doctrine
 *
 * @author vadim
 */
abstract class AbstractDoctrineMapper extends AbstractMapper implements EntityDoctrineManagerInterface
{

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * Get entityManager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (! $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager            
     * @return \Core\Mapper\AbstractDoctrineMapper
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}
