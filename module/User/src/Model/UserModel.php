<?php
namespace User\Model;

use Core\Model\AbstractModel;
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
     * Get form for update user data
     *
     * @param int $identifier
     * @return \User\Form\LoginForm
     */
    public function getUpdateForm($identifier)
    {
        /* @var $form \User\Form\RegistrationForm */
        $form = $this->getServiceLocator()->get('RegistrationForm');
        $form->bind($this->getMapper()->find($identifier));
        return $form;
    }

    /**
     * @return \Core\Form\AbstractForm
     */
    public function getRegistrationForm()
    {
        /* @var $form \User\Form\RegistrationForm */
        $form = $this->getServiceLocator()->get('RegistrationForm');
        $form->bind(new User());
        return $form;
    }

    /**
     * @return \User\Form\LoginForm
     */
    public function getLoginForm()
    {
        /* @var $form \User\Form\LoginForm */
        $form = $this->getServiceLocator()->get('LoginForm');
        $form->bind(new User());
        return $form;
    }

    public function create()
    {
        /* @var $roleModel \User\Model\RoleModel */
        $roleModel = $this->getServiceLocator()->get('RoleModel');
        
        /* @var $entity \User\Entity\User */
        $entity = $this->getForm()->getObject();
        var_dump($entity); die;
        $mapper = $this->getMapper();
        
        $entity->setSalt(md5(time()));
        $entity->setPassword(md5($entity->getPassword() . $entity->getSalt() . User::SECRET_KEY));
        
        $role = $roleModel->getMapper()->findOne(array(
            'name' => 'user'
        ));
        $entity->setRole($role);
        
        $mapper->create($entity);
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
