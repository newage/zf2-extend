<?php

namespace User\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class RestoreForm
 * @package User\Form
 */
class RestoreForm extends AbstractUserForm implements InputFilterProviderInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('restore');

        $this->add([
            'name' => 'restore_hash',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'send',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Change password',
                'id' => 'submitbutton'
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link \Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array_merge(
            parent::getInputFilterSpecification(),
            [
                'restore_hash' => [
                    'required' => true,
                    'validators' => [
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 32,
                                'max' => 40
                            ]
                        ],
                        [
                            'name' => 'DoctrineModule\Validator\ObjectExists',
                            'options' => [
                                'object_repository' => $this->getEntityManager()->getRepository('User\Entity\User'),
                                'fields' => 'restoreHash'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }
}
