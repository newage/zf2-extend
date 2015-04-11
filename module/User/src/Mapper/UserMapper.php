<?php
namespace User\Mapper;

use Core\Entity\EntityInterface;
use Core\Mapper\DoctrineMapper;
use User\Entity\User;

/**
 * Work with DB table users
 */
class UserMapper extends DoctrineMapper
{

    /**
     * Find one row
     * @param int $identifier
     * @return User
     */
    public function find($identifier)
    {
        return $this->getEntityManager()->getRepository('User\Entity\User')->find($identifier);
    }

    /**
     * Find rows by params
     * @param array|EntityInterface $params
     * @param array $order
     * @param null $limit
     * @return array|void
     */
    public function findBy(array $params, array $order = null, $limit = null)
    {
        return $this->getEntityManager()->getRepository('User\Entity\User')->findBy($params, $order, $limit);
    }

    /**
     * Find row
     * @param array|EntityInterface $params
     * @return EntityInterface
     */
    public function findOne(array $params)
    {
        return $this->getEntityManager()->getRepository('User\Entity\User')->findOneBy($params);
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
     * Get user by email
     * @param $email
     * @return EntityInterface
     */
    public function getUserByEmail($email)
    {
        return $this->findOne(['identifier'=> $email]);
    }

    /**
     * Disable user account

     * @param int $identifier
     * @return User
     */
    public function delete($identifier)
    {
        /* @var $entity \User\Entity\User */
        $entity = $this->getEntityManager()
            ->getRepository('User\Entity\User')
            ->find($identifier);
        $entity->setDisable();
        
        $this->persist($entity);
        return $entity;
    }

    /**
     * Create new user
     * @param User|EntityInterface $entity
     * @return User
     */
    public function create(EntityInterface $entity)
    {
        $entity->setEnable();
        $entity->setCreatedAt();
        $entity->setUpdatedAt();
        
        $this->persist($entity);
        return $entity;
    }

    /**
     * Update user
     * @param User|EntityInterface $entity
     * @return User
     */
    public function update(EntityInterface $entity)
    {
        $entity->setUpdatedAt();
        
        $this->persist($entity);
        return $entity;
    }
}
