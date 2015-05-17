<?php

namespace User\Form;


/**
 * Class LoginForm
 * @package User\Form
 */
class LoginForm extends AbstractUserForm
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('login');

        $this->add([
            'name' => 'send',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Login',
                'id' => 'submitbutton'
            ]
        ]);
    }
}
