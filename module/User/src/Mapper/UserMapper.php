<?php
namespace User\Mapper;

use Core\Mapper\DoctrineMapper;
use User\Entity\User;

/**
 * Work with DB table users
 */
class UserMapper extends DoctrineMapper
{

    /**
     * Find one row
     * @param int $id
     * @return User
     */
    public function find($id)
    {
        return $this->getEntityManager()->getRepository('User\Entity\User')->find($id);
    }

    /**
     * Find rows by params
     *
     * @param array $params
     * @param array $order
     * @param null $limit
     * @return array|void
     */
    public function findBy(array $params, array $order = null, $limit = null)
    {
        $this->getEntityManager()->getRepository('User\Entity\User')->findBy($params, $order, $limit);
    }

    public function findOne(array $params)
    {
        // $em = $this->getEntityManager();
        // return $em->getRepository('User\Entity\User')->find((int)$id);
    }

    /**
     * Get all registered users
     * @return array|void
     */
    public function getUsers()
    {
        return $this->getEntityManager()->getRepository('User\Entity\User')->findAll();
    }

    /**
     * Disable user account
     *
     * @param int $id            
     * @return User
     */
    public function delete($id)
    {
        /* @var $entity \User\Entity\User */
        $entity = $this->getEntityManager()
            ->getRepository('User\Entity\User')
            ->find($id);
        $entity->setDisable();
        
        $this->persist($entity);
        return $entity;
    }

    /**
     * Create new user
     *
     * @param User $entity            
     * @return User
     */
    public function create($entity)
    {
        $entity->setEnable();
        $entity->setCreatedAt();
        $entity->setUpdatedAt();
        
        $this->persist($entity);
        return $entity;
    }

    /**
     * Udaet user
     *
     * @param User $entity            
     * @return User
     */
    public function update($entity)
    {
        $entity->setUpdatedAt();
        
        $this->persist($entity);
        return $entity;
    }
}
