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
class RoleForm extends Form
{

    public function init()
    {
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton'
            )
        ));
    }

    public function getInputFilter()
    {
        if (! $this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'parent_id',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'name',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3
                        )
                    )
                )
            )));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}
