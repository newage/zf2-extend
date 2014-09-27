<?php
namespace User\Mapper;

use Core\Mapper\AbstractDoctrineMapper;
use User\Entity\Role;

/**
 * Mapper for role entity
 *
 * @author V.Leontiev
 */
class RoleMapper extends AbstractDoctrineMapper
{

    /**
     * Find one row
     *
     * @param type $id            
     * @return Role
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\Role')->find((int) $id);
    }

    public function findBy($params)
    {}

    public function findOne($params)
    {
        if (! is_array($params)) {
            throw new \Zend\Stdlib\Exception\InvalidArgumentException('Params in not array');
        }
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\Role')->findOneBy($params);
    }

    /**
     * Disable role
     *
     * @param int $id            
     * @return Role
     */
    public function delete($id)
    {
        return $entity;
    }

    /**
     * Create new role
     *
     * @param Role $entity            
     * @return Role
     */
    public function create($entity)
    {
        return $entity;
    }

    /**
     * Udate role
     *
     * @param Role $entity            
     * @return Role
     */
    public function update($entity)
    {
        return $entity;
    }
}
