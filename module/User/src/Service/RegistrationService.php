<?php

namespace User\Service;

use Core\Service\AbstractService;
use User\Entity\User;

/**
 * Class RegistrationService
 * @package User\Service
 */
class RegistrationService extends AbstractService
{

    /**
     * Create user in database
     * @return User
     */
    public function registration()
    {
        /* @var $roleModel \User\Model\RoleModel */
        $roleModel = $this->getServiceLocator()->get('RoleModel');
        $roleEntity = $roleModel->getDefaultRole();

        /* @var $userModel \User\Model\UserModel */
        $userModel = $this->getServiceLocator()->get('UserModel');
        /* @var $userEntity \User\Entity\User */
        $userEntity = $this->getForm()->getObject();
        $userModel->create($userEntity, $roleEntity);

        $this->getEventManager()->trigger(
            __METHOD__,
            $this,
            ['email' => $userEntity->getIdentifier()]
        );

        return $userEntity;
    }
}