<?php

namespace User\Service;

use Core\Service\AbstractService;
use User\Entity\User;

/**
 * Class RestoreService
 * @package User\Service
 */
class RestoreService extends AbstractService
{

    /**
     * Get user form and set validation group
     */
    public function getForm()
    {
        $form = parent::getForm();
        $form->setValidationGroup(['restore_hash', 'password', 'identical']);
        return $form;
    }

    /**
     *
     */
    public function restore()
    {
        /* @var $userModel \User\Model\UserModel */
        $userModel = $this->getServiceLocator()->get('UserModel');
        /* @var $userEntity \User\Entity\User */
        $userEntity = $this->getForm()->getObject();
        $userEntity = $userModel->updatePassword($userEntity);

        $this->getEventManager()->trigger(
            __METHOD__,
            $this,
            $this->createEmailValues($userEntity)
        );

        return $userEntity;
    }

    /**
     * Create email template
     * @param User $userEntity
     * @return array
     */
    protected function createEmailValues(User $userEntity)
    {
        return [
            'email' => $userEntity->getIdentifier()
        ];
    }
}
