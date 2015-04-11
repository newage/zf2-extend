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
     * @var int
     */
    protected $identity = null;

    /**
     * Make hash, enable user, set role and insert user to DB
     * @param \User\Entity\User $entityUser
     * @param \User\Entity\Role $entityRole
     * @return \User\Entity\User
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
     * Create hash for user for restore password
     * @param \User\Entity\User $entityUser
     * @return \User\Entity\User
     */
    public function createHash(User $entityUser)
    {
        /* @var $entityUser \User\Entity\User */
        $entityUser = $this->getMapper()->getUserByEmail($entityUser->getIdentifier());
        $entityUser->setRestoreHash(md5(microtime() . uniqid()));
        $entityUser->setRestoreHashCreatedAt();

        return $this->getMapper()->update($entityUser);
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
     * Get current user
     * @return User
     */
    public function getCurrentUser()
    {

    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param int $identity
     * @return $this
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @return \User\Mapper\UserMapper
     */
    protected function getMapper()
    {
        return parent::getMapper();
    }
}
