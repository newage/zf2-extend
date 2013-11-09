<?php

namespace User\Controller;

use Zend\View\Model\ViewModel;
use Core\Mvc\Controller\EntityController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use User\Entity\User;
use User\Form\UserForm;

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
    
    public function loginAction()
    {
        
    }
    
    /**
     * Update user
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function updateAction()
    {
        if (!$this->params('id')) {
            
        }
        
        $em = $this->getEntityManager();
        $entityUser = $em->getRepository('User\Entity\User')->find($this->params('id'));
        
        /* @var $form \User\Form\UserForm */
        $form = $this->getServiceLocator()->get('UserForm');
        $form->setHydrator(new DoctrineObject($em, $entityUser));
        $form->bind($entityUser);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                if ($form->hasAttribute('parent_id')) {
                    $entityUser->setRole(
                        $em->getRepository('User\Entity\Role')->findOneBy(
                            array('id' => $form->getAttribute('parent_id'))
                        )
                    );
                }
                $entityUser->setUpdatedAt();
                
                $em->persist($entityUser);
                $em->flush();

                $this->flashMessenger()->addSuccessMessage('User Updated');

                return $this->redirect()->toRoute('user', array('controller' => 'index', 'action' => 'update'));
            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    /**
     * Registration new user
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function createAction()
    {
        $entityUser = new User;
        $em = $this->getEntityManager();

//        $classMethodsHydrator = new \Zend\Stdlib\Hydrator\ClassMethods(false);
//        $classMethodsHydrator->addStrategy('password', new \User\Hydrator\Strategy\MD5());
        
        /* @var $form \User\Form\UserForm */
        $form = $this->getServiceLocator()->get('UserForm');
        $form->setHydrator(new DoctrineObject($em, $entityUser));
        $form->bind($entityUser);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $entityUser->setRole($em->getRepository('User\Entity\Role')->findOneBy(array('name' => 'user')));
                $entityUser->setStatus('ENABLED');
                $entityUser->setCreatedAt();
                $entityUser->setUpdatedAt();
                
                $em->persist($entityUser);
                $em->flush();

                $this->flashMessenger()->addSuccessMessage('User Saved');

                return $this->redirect()->toRoute('user.create');
            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function logoutAction()
    {
        
    }
}
