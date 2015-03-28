<?php
namespace User\Model;

use Core\Model\AbstractModel;
use User\Entity\Role;
use User\Entity\User;
use User\Mapper\UserMapper;
use Zend\Form\Form;
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
     * @param UserMapper $mapper
     * @param User $entityUser
     * @param Role $entityRole
     * @return User
     */
    public function create(UserMapper $mapper, User $entityUser, Role $entityRole)
    {
        $entityUser->setSalt(md5(time()));
        $entityUser->setPassword(md5($entityUser->getPassword() . $entityUser->getSalt() . User::SECRET_KEY));
        $entityUser->setRole($entityRole);

        return $mapper->create($entityUser);
    }

    public function update()
    {
        $roleId = $this->getForm()->getValue('role_id');
        /* @var $entity \User\Entity\User */
        $entity = $this->getForm()->getObject();
        $mapper = $this->getMapper();
        
        if ($roleId) {
            /* @var $roleModel \User\Model\RoleModel */
            $roleModel = $this->getServiceLocator()->get('RoleModel');
            
            $role = $roleModel->getMapper()->find($roleId);
            $entity->setRole($role);
        }
        
        $mapper->update($entity);
    }
}
