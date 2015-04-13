<?php

namespace User\Service;

use Core\Service\AbstractService;
use User\Entity\User;

/**
 * Class ForgotService
 * @package User\Service
 */
class ForgotService extends AbstractService
{

    /**
     * Get login form and set validation group
     * @return \User\Form\RegistrationForm
     */
    public function getForm()
    {
        $form = parent::getForm();
        $form->setValidationGroup(['identifier']);
        return $form;
    }

    /**
     * Create hash for restore forgotten password
     * @return \User\Entity\User
     */
    public function forgot()
    {
        /* @var $userModel \User\Model\UserModel */
        $userModel = $this->getServiceLocator()->get('UserModel');
        /* @var $userEntity \User\Entity\User */
        $userEntity = $this->getForm()->getObject();
        $userEntity = $userModel->createHash($userEntity);

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
            'email' => $userEntity->getIdentifier(),
            'hash' => $userEntity->getRestoreHash()
        ];
    }
}
