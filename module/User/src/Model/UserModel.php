<?php
namespace User\Model;

use Core\Model\AbstractModel;
use User\Entity\Role;
use User\Entity\User;
use Zend\Stdlib\Hydrator;

/**
 * Model with business logic for user entity/form/mapper
 *
 * @author V.Leontiev
 */
class UserModel extends AbstractModel
{

    /**
     * Encode password for user and insert new user to DB
     * @param User $entityUser
     * @param Role $entityRole
     * @return User
     */
    public function create(User $entityUser, Role $entityRole)
    {
        $entityUser->setSalt(md5(time()));
        $entityUser->setPassword(md5($entityUser->getPassword() . $entityUser->getSalt() . User::SECRET_KEY));
        $entityUser->setRole($entityRole);

        return $this->getMapper()->create($entityUser);
    }

    /**
     * Get registered users
     * @return array|void
     */
    public function getUsers()
    {
        return $this->getMapper()->getUsers();
    }

    /**
     * @return \User\Mapper\UserMapper
     */
    protected function getMapper()
    {
        return parent::getMapper();
    }
}
