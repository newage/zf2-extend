<?php

namespace User\Mapper;

use Core\Mapper\AbstractDoctrineMapper;
use User\Entity\User;

/**
 * Description of User
 *
 * @author V.Leontiev
 */
class UserMapper extends AbstractDoctrineMapper
{
    
    /**
     * Find one row
     * 
     * @param type $id
     * @return User
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        return $em->getRepository('User\Entity\User')->find((int)$id);
    }
    
    public function findBy($params)
    {
//        $em = $this->getEntityManager();
//        return $em->getRepository('User\Entity\User')->find((int)$id);
    }

    public function findOne($params)
    {
//        $em = $this->getEntityManager();
//        return $em->getRepository('User\Entity\User')->find((int)$id);
    }
    
    /**
     * Disable user account
     * 
     * @param int $id
     * @return User
     */
    public function delete($id)
    {
        $entity = $this->getEntityManager()->getRepository('User\Entity\User')->find($id);
        $entity->setStatus(User::STATUS_DISABLE);
        
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
        $entity->setStatus(User::STATUS_ENABLE);
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
