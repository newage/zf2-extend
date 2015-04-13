<?php

namespace User\Form;


/**
 * Class ForgotForm
 * @package User\Form
 */
class ForgotForm extends AbstractUserForm
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('forgot');

        $this->add([
            'name' => 'send',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Send instructions',
                'id' => 'submitbutton'
            ]
        ]);
    }
}
