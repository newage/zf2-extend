<?php
namespace Core\Model;

use Zend\Form\Form;
use Core\Form\AbstractForm;
use Core\Mapper\AbstractMapper;

/**
 * Model with business logic for user entity/form/mapper
 *
 * @author V.Leontiev
 */
abstract class AbstractModel
{

    /**
     * Form object
     * 
     * @var AbstractForm
     */
    protected $form;

    /**
     * Mapper object
     * 
     * @var AbstractMapper
     */
    protected $mapper;

    /**
     * Set current form
     *
     * @param Form $form
     * @return AbstractModel
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * Get current form
     * 
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Get mapper
     *
     * @return AbstractMapper
     */
    protected function getMapper()
    {
        return $this->mapper;
    }

    /**
     * Set mapper
     *
     * @param AbstractMapper $mapper
     * @return AbstractModel
     */
    public function setMapper(AbstractMapper $mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }
}