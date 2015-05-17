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

        $this->add([
            'name' => 'identifier',
            'type' => 'text',
            'options' => [
                'label' => 'Email'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Password'
            ]
        ]);

        $this->add([
            'name' => 'identical',
            'type' => 'password',
            'options' => [
                'label' => 'Password Verify'
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'identifier' => [
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress'
                    ]
                ]
            ],
            'password' => [
                'required' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 3
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'identical' => [
                'required' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 3
                        ]
                    ],
                    [
                        'name' => 'Identical',
                        'options' => [
                            'token' => 'password',
                            'message' => 'Passwords not match!'
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ]
        ];
    }
}
