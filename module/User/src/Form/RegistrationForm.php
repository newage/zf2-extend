<?php
namespace User\Form;

use Core\Form\AbstractDoctrineForm as Form;
use User\Entity\User;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Registration form for user
 *
 * @author V.Leontiev
 */
class RegistrationForm extends AbstractUserForm
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('registration');

        $this->add([
            'name' => 'send',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Registration',
                'id' => 'submitbutton'
            ]
        ]);
    }
}
