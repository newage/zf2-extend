<?php
use Zend\ServiceManager\ServiceManager;

return array(
    'data-fixture' => array(
        'User_fixture' => __DIR__ . '/../src/Fixture'
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'application_entities'
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array()
            // 'metadata_cache' => 'zend.static.local',
            // 'query_cache' => 'zend.static.local',
            // 'result_cache' => 'zend.static.local',
            
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController'
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'RoleMapper' => 'User\Mapper\RoleMapper',
            'RoleForm' => 'User\Form\RoleForm',
            'UserMapper' => 'User\Mapper\UserMapper',
            'RegistrationForm' => 'User\Form\RegistrationForm',
            'LoginForm' => 'User\Form\LoginForm'
        ),
        'factories' => array(
            'doctrine.cache.zend.static.local' => function (ServiceManager $sm) {
                return new \DoctrineModule\Cache\ZendStorageCache($sm->get('cache.static.local'));
            },
            'UserModel' => function (ServiceManager $sm) {
                $model = new \User\Model\UserModel();
                $model->setServiceLocator($sm);
                $model->setForm($sm->get('RegistrationForm'));
                $model->setMapper($sm->get('UserMapper'));
                return $model;
            },
            'RoleModel' => function (ServiceManager $sm) {
                $model = new \User\Model\RoleModel();
                $model->setServiceLocator($sm);
                $model->setForm($sm->get('RoleForm'));
                $model->setMapper($sm->get('RoleMapper'));
                return $model;
            }
        )
    ),
    // 'view_helpers' => array(
    // 'invokables' => array(
    // 'bootstrapForm' => 'Application\View\Helper\NavLinkHelper'
    // )
    // ),
    'view_manager' => array(
        'template_map' => array(
            'template_map' => include __DIR__  .'/../template_map.php',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);
