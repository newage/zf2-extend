<?php
namespace Core\Entity;

/**
 * Entity Manager interface
 *
 * @author V.Leontiev
 */
interface EntityDoctrineManagerInterface
{

    /**
     * Get entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager            
     */
    public function getEntityManager();

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager            
     * @return \Core\Mapper\doctrineMapper
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager);
}
