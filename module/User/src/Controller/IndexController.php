<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Mapper\UserMapper;
use User\Form\RegistrationForm;
use User\Model\UserModel;

/**
 * Description of Index
 *
 * @author vadim
 */
class IndexController extends AbstractActionController
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
        /* @var $model \User\Model\UserModel */
        $model = $this->getServiceLocator()->get('UserModel');
        $users = $model->getUsers();

        $view = new ViewModel();
        $view->setTemplate('user/index/index');
        $view->setVariables([
            'users' => $users
        ]);
        return $view;
    }

    /**
     * Authentication
     * @return ViewModel
     */
    public function loginAction()
    {
        /* @var $service \User\Service\LoginService */
        $service = $this->getServiceLocator()->get('LoginService');
        $form = $service->getForm();

        /* @var $request \Zend\Http\PhpEnvironment\Request */
        $request = $this->getRequest();
        $errors = [];
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $authResult = $service->login();

                if ($authResult->isValid()) {
                    $this->flashMessenger()->addSuccessMessage('User logged in');
                    return $this->redirect()->toRoute('home');
                } else {
                    $errors = $authResult->getMessages();
                }
            }
        }
        $view = new ViewModel();
        $view->setTemplate('user/index/login');
        $view->setVariables([
            'form' => $form,
            'errors' => $errors
        ]);
        return $view;
    }

    /**
     * Registration new user
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function registrationAction()
    {
        /* @var $service \User\Service\RegistrationService */
        $service = $this->getServiceLocator()->get('RegistrationService');
        $form = $service->getForm();

        /* @var $request \Zend\Http\PhpEnvironment\Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $service->registration();
                $this->flashMessenger()->addSuccessMessage('User registered');
                return $this->redirect()->toRoute('login');
            }
        }
        
        $view = new ViewModel();
        $view->setVariables([
            'form' => $form
        ]);
        $view->setTemplate('user/index/registration');
        return $view;
    }

    /**
     * Logout user
     * @return ViewModel
     */
    public function logoutAction()
    {
        return new ViewModel();
    }
}
