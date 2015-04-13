<?php
namespace User\Controller;

use Core\Mvc\Controller\AbstractExtendController;
use Zend\View\Model\ViewModel;
use User\Mapper\UserMapper;
use User\Form\RegistrationForm;
use User\Model\UserModel;

/**
 * Description of Index
 * @author vadim
 */
class IndexController extends AbstractExtendController
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
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $authResult = $service->login();

                if ($authResult->isValid()) {
                    $this->flashMessenger()->addSuccessMessage('User logged in');
                    return $this->redirect()->toRoute('home');
                } else {
                    $this->messenger()->addErrorMessage('A user account not be found or disable');
                }
            }
        }
        $view = new ViewModel();
        $view->setTemplate('user/index/login');
        $view->setVariables([
            'form' => $form
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
        /* @var $authService \Zend\Authentication\AuthenticationService */
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $authService->clearIdentity();
        return $this->redirect()->toRoute('home');
    }

    /**
     * Show forgot form with email
     * @return ViewModel
     */
    public function forgotAction()
    {
        /* @var $service \User\Service\ForgotService */
        $service = $this->getServiceLocator()->get('ForgotService');
        $form = $service->getForm();

        /* @var $request \Zend\Http\PhpEnvironment\Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service->forgot();
                $this->flashMessenger()->addSuccessMessage('Instructions sent to your email');
                return $this->redirect()->toRoute('login');
            }
        }

        $view = new ViewModel();
        $view->setVariables([
            'form' => $form
        ]);
        $view->setTemplate('user/index/forgot');
        return $view;
    }

    /**
     * Show restore form with password field
     * @return ViewModel
     */
    public function restoreAction()
    {
        /* @var $service \User\Service\RestoreService */
        $service = $this->getServiceLocator()->get('RestoreService');
        $form = $service->getForm();

        /* @var $request \Zend\Http\PhpEnvironment\Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service->restore();
                $this->flashMessenger()->addSuccessMessage('Your password was change');
                return $this->redirect()->toRoute('login');
            } elseif ($form->get('restore_hash')->getMessages()) {
                $this->messenger()->addErrorMessage('Hash is wrong');
            }
        }

        $view = new ViewModel();
        $view->setVariables([
            'form' => $form,
            'hash' => $this->params('hash')
        ]);
        $view->setTemplate('user/index/restore');
        return $view;
    }
}
