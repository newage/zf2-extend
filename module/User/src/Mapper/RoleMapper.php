<?php
namespace User\Mapper;

use Core\Mapper\doctrineMapper;
use Core\Mapper\Exception\InvalidArgumentException;
use User\Entity\Role;

/**
 * Mapper for role entity
 *
 * @author V.Leontiev
 */
class RoleMapper extends doctrineMapper
{

    /**
     * Find one row
     * @param int $id
     * @return Role
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\Role')->find($id);
    }

    public function findBy($params)
    {
        return null;
    }

    /**
     * Find one entity by parameters
     * @param array $params
     * @return Role
     */
    public function findOne($params)
    {
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
        return null;
    }

    /**
     * Create new role
     *
     * @param Role $entity            
     * @return Role
     */
    public function create($entity)
    {
        return null;
    }

    /**
     * Udate role
     *
     * @param Role $entity            
     * @return Role
     */
    public function update($entity)
    {
        return null;
    }
}
