<?php

namespace User\Form;

use Core\Form\AbstractDoctrineForm;
use User\Entity\User;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Class AbstractUserForm
 * @package User\Form
 */
abstract class AbstractUserForm extends AbstractDoctrineForm implements InputFilterProviderInterface
{

    /**
     * Constructor
     * @param string $name
     */
    public function __construct($name = 'user')
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator())
            ->setInputFilter(new InputFilter())
            ->bind(new User());

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
                        'name' => 'EmailAddress',
                        'options' => [
                            'break_chain_on_failure' => true
                        ]
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
