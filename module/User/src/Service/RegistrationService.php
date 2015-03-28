<?php

namespace User\Service;

use User\Entity\User;
use User\Form\RegistrationForm;

/**
 * Class RegistrationService
 * @package User\Service
 */
class RegistrationService extends AbstractService
{

    /**
     * @var RegistrationForm
     */
    protected $registrationForm;

    /**
     * Get registration form
     * @return RegistrationForm
     */
    public function getCurrentForm()
    {
        if (!$this->registrationForm instanceof RegistrationForm) {
            $form = parent::getForm('RegistrationForm');
            $form->bind(new User());
            $this->registrationForm = $form;
        }
        return $this->registrationForm;
    }

    /**
     * Create user in database
     */
    public function registration()
    {
        /* @var $roleModel \User\Model\RoleModel */
        $roleModel = $this->getServiceManager()->get('RoleModel');
        $roleEntity = $roleModel->getDefaultRole();

        /* @var $userModel \User\Model\UserModel */
        $userModel = $this->getServiceManager()->get('UserModel');
        /* @var $userEntity \User\Entity\User */
        $userEntity = $this->getCurrentForm()->getObject();
        $userModel->create($userEntity, $roleEntity);

        $this->getEventManager()->trigger(
            __METHOD__,
            $this,
            ['email' => $userEntity->getIdentifier()]
        );
    }
}