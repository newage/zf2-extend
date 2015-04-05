<?php

namespace User\Service;

use Core\Service\AbstractService;
use Zend\Authentication\Result;

/**
 * Service use for authentication user
 * @package User\Service
 */
class LoginService extends AbstractService
{

    /**
     * Get login form and set validation group
     */
    public function getForm()
    {
        $form = parent::getForm();
        $form->setValidationGroup(['identity' => ['identifier', 'password']]);
        return $form;
    }

    /**
     * Start action
     *
     * @return Result
     */
    public function login()
    {
        /* @var $authService \Zend\Authentication\AuthenticationService */
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        /* @var $adapter \User\Adapter\ObjectRepository */
        $adapter = $authService->getAdapter();

        /* @var $userEntity \User\Entity\User */
        $userEntity = $this->getForm()->getObject();

        $adapter->setIdentity($userEntity->getIdentifier());
        $adapter->setCredential($userEntity->getPassword());
        return $authService->authenticate();
    }
}

