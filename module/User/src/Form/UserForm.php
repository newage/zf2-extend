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
class UserForm extends Form
{

    /**
     * Constructor
     * @param string $formName
     */
    public function __construct($formName = 'user')
    {
        parent::__construct($formName);

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator())
            ->setInputFilter(new InputFilter())
            ->bind(new User());

        /* Use field set for example */
        $this->add([
            'type' => 'User\Form\IdentifierFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

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
