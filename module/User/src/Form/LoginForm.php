<?php
namespace User\Form;

use Core\Form\AbstractDoctrineForm as Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

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
            ->setHydrator(new ClassMethodsHydrator())
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
