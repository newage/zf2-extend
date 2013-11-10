<?php

namespace User\Model;

use Core\Model\AbstractModel;
use User\Entity\User;

/**
 * Model with business logic for user entity/form/mapper
 *
 * @author V.Leontiev
 */
class UserModel extends AbstractModel
{

    /**
     * 
     * @TODO Move set filters
     * @return type
     */
    public function getUpdateUserForm()
    {
        $factory = new \Zend\InputFilter\Factory();
        $form = $this->getUserForm();
        $inputFilter = $form->getInputFilter();
        $inputFilter->remove('email');
        $inputFilter->add(
            $factory->createInput(
                array(
                    'name' => 'email',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'EmailAddress',
                        ),
                    )
                )
            )
        );
        $form->setInputFilter($inputFilter);
        return $form;
    }
    
    public function getUserForm()
    {
        $form = $this->getForm();
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());
        $form->setMapper($this->getMapper());
        $form->bind(new \User\Entity\User);
        return $form;
    }
    
    public function create()
    {
        /* @var $entity \User\Entity\User */
        $entity = $this->getForm()->getObject();
        $mapper = $this->getMapper();
        
        $entity->setSalt(md5(time()));
        $entity->setPassword(md5($entity->getPassword() . $entity->getSalt() . User::SECRET_KEY));
        
        $role = $mapper->getEntityManager()->getRepository('User\Entity\Role')->findOneBy(
            array('name' => 'user')
        );
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
            $entity->setRole(
                $this->getEntityManager()->getRepository('User\Entity\Role')->findOneBy(
                    array('id' => $roleId)
                )
            );
        }
        
        $mapper->update($entity);
    }
}
