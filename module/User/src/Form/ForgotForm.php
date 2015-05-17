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

    /**
     * Should return an array specification compatible with
     * {@link \Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        $filters = parent::getInputFilterSpecification();
        $filters['identifier']['validators'][] = [
            'name' => 'DoctrineModule\Validator\ObjectExists',
            'options' => [
                'object_repository' => $this->getEntityManager()->getRepository('User\Entity\User'),
                'fields' => 'identifier',
                'messages' => [
                    'noObjectFound' => 'A user with this email not exists!'
                ]
            ]
        ];
        return $filters;
    }
}
