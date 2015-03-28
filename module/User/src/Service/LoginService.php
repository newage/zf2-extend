<?php

namespace User\Service;

use Core\Mapper\doctrineMapper;
use User\Form\LoginForm;
use User\Mapper\UserMapper;
use Core\Form\AbstractDoctrineForm as Form;

/**
 * Service use for authentication user
 * @package User\Service
 */
class LoginService extends AbstractService
{

    public function getForm()
    {
        return parent::getForm('LoginForm');
    }

    /**
     * Start action
     *
     * @return bool
     */
    public function action()
    {
        // TODO: Implement action() method.
    }


}