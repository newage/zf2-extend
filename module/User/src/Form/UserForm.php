<?php

namespace User\Form;

use Core\Form\AbstractDoctrineForm as Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * Registration form for user
 *
 * @author V.Leontiev
 */
class UserForm extends Form
{
    
    public function init()
    {
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'type'  => 'text',
            'options' => array('label' => 'Email'),
        ));

        $this->add(array(
            'name' => 'password',
            'type'  => 'password',
            'options' => array('label' => 'Password'),
        ));
        
        $this->add(array(
            'name' => 'passwordVerify',
            'type'  => 'password',
            'options' => array('label' => 'Password Verify'),
        ));

        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Value',
                'id' => 'submitbutton',
            ),
        ));
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $entityManager = $this->getEntityManager();
            $inputFilter   = new InputFilter();
            $factory       = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'role',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'email',
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
                                'objectFound' => 'Sorry, a user with this email already exists !'
                            )
                        )
                    )
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'password',
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
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'passwordVerify',
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                        ),
                    ),
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'password',
                            'message' => 'Passwords not match !'
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            )));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}
