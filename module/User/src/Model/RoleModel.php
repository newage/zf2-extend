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

    /**
     * @return Role
     */
    public function getDefaultRole()
    {
        $role = $this->getMapper()->findOne(array(
            'name' => 'user'
        ));
        return $role;
    }
}
