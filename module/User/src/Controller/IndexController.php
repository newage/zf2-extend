<?php
namespace User\Controller;

use Zend\View\Model\ViewModel;
use Core\Mvc\Controller\EntityController;
use User\Mapper\UserMapper;
use User\Form\RegistrationForm;
use User\Model\UserModel;

/**
 * Description of Index
 *
 * @author vadim
 */
class IndexController extends EntityController
{

    /**
     * @var RegistrationForm
     */
    protected $userForm;

    /**
     * @var UserMapper
     */
    protected $userMapper;

    /**
     * @var UserModel
     */
    protected $userModel;

    /**
     * Show info about current user
     * @return ViewModel
     */
    public function indexAction()
    {
        $em = $this->getEntityManager();
        
        $users = $em->getRepository('User\Entity\User')->findBy(array(), array(
            'id' => 'ASC'
        ));
        
        return new ViewModel(array(
            'users' => $users
        ));
    }

    /**
     * Authentication
     * @return ViewModel
     */
    public function loginAction()
    {
        $model = $this->getUserModel();
        $form = $model->getLoginForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $model->create();
                $this->flashMessenger()->addSuccessMessage('User Logined');
                return $this->redirect()->toRoute('login');
            }
        }
        $view = new ViewModel();
        $view->setTemplate('user/index/login');
        $view->setVariables(array(
            'form' => $form
        ));
        return $view;
    }

    /**
     * Update user
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function updateAction()
    {
        $model = $this->getUserModel();
        $form = $model->getUpdateForm($this->params('id'));
//        $form->setData(array(
//            'id' => $this->params('id')
//        ));
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $model->update();
                
                $this->flashMessenger()->addSuccessMessage('User Updated');
                return $this->redirect()->toRoute('user/update');
            }
        } else {
            $form = $this->getUserModel()->getForm();
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
        $model = $this->getUserModel();
        $form = $model->getRegistrationForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $model->create();
                $this->flashMessenger()->addSuccessMessage('User Saved');
                return $this->redirect()->toRoute('user/create');
            }
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function logoutAction()
    {}

    /**
     *
     * @return UserModel
     */
    public function getUserModel()
    {
        if (! $this->userModel) {
            $this->setUserModel($this->getServiceLocator()->get('UserModel'));
        }
        return $this->userModel;
    }

    public function setUserModel(UserModel $model)
    {
        $this->userModel = $model;
        return $this;
    }
}
