<?php
namespace Core\Mapper;

use Core\Entity\EntityDoctrineManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Abstract mapper for doctrine
 */
abstract class DoctrineMapper extends AbstractMapper implements EntityDoctrineManagerInterface
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
        if (!$this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

    /**
     * Set entity manager
     *
     * @param EntityManager $entityManager
     * @return \Core\Mapper\doctrineMapper
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * Execute action for entity
     *
     * @param $entity
     * @return bool|int
     */
    public function persist($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }
}
