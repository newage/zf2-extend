<?php

namespace User\Form;

use User\Entity\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Class EmailField
 * Get email and password fields and filters
 * @package User\Form
 * @author V.Leontiev
 */
class IdentifierFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('identity');

        $this->setHydrator(new ClassMethodsHydrator())
            ->setObject(new User());

        $this->add(array(
            'name' => 'identifier',
            'type' => 'text',
            'options' => array(
                'label' => 'Email'
            )
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password'
            )
        ));

        $this->add(array(
            'name' => 'identical',
            'type' => 'password',
            'options' => array(
                'label' => 'Password Verify'
            )
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'identifier' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'EmailAddress'
                    )
                )
            ),
            'password' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3
                        )
                    )
                ),
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            'identical' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3
                        )
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'password',
                            'message' => 'Passwords not match!'
                        )
                    )
                ),
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                )
            )
        );
    }
}
