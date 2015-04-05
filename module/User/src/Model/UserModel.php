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
     * Make hash, enable user, set role and insert user to DB
     * @param User $entityUser
     * @param Role $entityRole
     * @return User
     */
    public function create(User $entityUser, Role $entityRole)
    {
        $options = [
            'cost' => 10,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $passwordHash = password_hash($entityUser->getPassword(), PASSWORD_BCRYPT, $options);
        $entityUser->setPassword($passwordHash);
        $entityUser->setRole($entityRole);
        $entityUser->setEnable();

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
