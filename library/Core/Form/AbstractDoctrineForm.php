<?php
namespace Core\Form;

use Core\Entity\EntityDoctrineManagerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of AbstractDoctrineForm
 *
 * @author V.Leontiev
 */
abstract class AbstractDoctrineForm extends AbstractForm implements EntityDoctrineManagerInterface
{

    /**
     * @TODO need remove entity manager
     * 
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * Get entityManager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

    /**
     * Set entity manager
     *
     * @param \Doctrine\ORM\EntityManager $entityManager            
     * @return \Core\Mapper\AbstractDoctrineMapper
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}
