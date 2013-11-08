<?php

namespace User\Controller;

use Zend\View\Model\ViewModel;
use Core\Mvc\Controller\EntityController;

/**
 * Description of Index
 *
 * @author vadim
 */
class IndexController extends EntityController
{
    
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(\Doctrine\ORM\EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }
    
    public function indexAction()
    {
        $em = $this->getEntityManager();

        $users = $em->getRepository('User\Entity\Users')->findBy(array(), array('id' => 'ASC'));

        return new ViewModel(array('users' => $users));
    }
}
