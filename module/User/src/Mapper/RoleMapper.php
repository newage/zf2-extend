<?php
namespace User\Mapper;

use Core\Mapper\DoctrineMapper;
use User\Entity\Role;

/**
 * Mapper for role entity
 */
class RoleMapper extends DoctrineMapper
{

    /**
     * Find one row
     * @param int $identifier
     * @return Role
     */
    public function find($identifier)
    {
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\Role')->find($identifier);
    }

    public function findBy(array $params, array $order = null, $limit = null)
    {
        return null;
    }

    /**
     * Find one entity by parameters
     * @param array|EntityInterface $params
     * @return Role
     */
    public function findOne(array $params)
    {
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\Role')->findOneBy($params);
    }

    /**
     * Disable role

     * @param int $identifier
     * @return Role
     */
    public function delete($identifier)
    {
        return null;
    }

    /**
     * Create new role
     * @param Role|EntityInterface $entity
     * @return Role
     */
    public function create(EntityInterface $entity)
    {
        return null;
    }

    /**
     * Update role
     * @param Role|EntityInterface $entity
     * @return Role
     */
    public function update(EntityInterface $entity)
    {
        return null;
    }
}
