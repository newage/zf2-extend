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
    
    public function indexAction()
    {
        $em = $this->getEntityManager();

        $users = $em->getRepository('User\Entity\User')->findBy(array(), array('id' => 'ASC'));

        return new ViewModel(array('users' => $users));
    }
}
