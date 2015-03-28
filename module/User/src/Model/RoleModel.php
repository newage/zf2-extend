<?php
namespace User\Model;

use Core\Model\AbstractModel;
use User\Entity\Role;
use User\Mapper\RoleMapper;
use Zend\Stdlib\Hydrator;

/**
 * Model for role
 *
 * @author V.Leontiev
 */
class RoleModel extends AbstractModel
{

    /**
     * @param $mapper
     * @return Role
     */
    public function getDefaultRole(RoleMapper $mapper)
    {
        $role = $mapper->findOne(array(
            'name' => 'user'
        ));
        return $role;
    }
}
