<?php

namespace User\Form;

use Core\Form\AbstractForm as Form;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Registration form for user
 *
 * @author V.Leontiev
 */
class UserForm extends Form implements InputFilterProviderInterface
{
    protected $inputFilter;
    
    public function init()
    {
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'type'  => 'text',
            'options' => array('label' => 'Email'),
            'attributes' => array(
                'required' => true
            )
        ));

        $this->add(array(
            'name' => 'password',
            'type'  => 'password',
            'options' => array('label' => 'Password'),
            'attributes' => array(
                'required' => true
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Registration',
                'id' => 'submitbutton',
            ),
        ));
    }
    
    public function getInputFilterSpecification()
    {
        $entityManager = $this->getEntityManager();
        return array(
            'id' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                )
            ),
            'email' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'EmailAddress',
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' => $entityManager->getRepository('User\Entity\User'),
                            'fields' => 'email',
                            'messages' => array(
                                'objectFound' => 'Sorry, a user with this email already exists!'
                            )
                        )
                    )
                ),
            ),
            'password' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                        ),
                    ),
                ),
            )
        );
    }
}
