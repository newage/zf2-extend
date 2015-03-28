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
     * Mapper object
     * 
     * @var AbstractMapper
     */
    protected $mapper;

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