<?php

namespace User\Model;

use Core\Model\AbstractModel;
use User\Entity\Role;
use Zend\Stdlib\Hydrator;

/**
 * Model for role
 *
 * @author V.Leontiev
 */
class RoleModel extends AbstractModel
{
    public function getRoleForm()
    {
        $form = $this->getForm();
        $form->setHydrator(new Hydrator\ClassMethods());
        $form->setMapper($this->getMapper());
        $form->bind(new Role);
        return $form;
    }
}
