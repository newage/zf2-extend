<?php
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Login form for user
 * @author V.Leontiev
 */
class LoginForm extends Form
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('login');

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethods())
            ->setInputFilter(new InputFilter());
        
        $this->add(array(
            'type' => 'User\Form\IdentifierFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Log in',
                'id' => 'submitbutton'
            )
        ));
    }
}
