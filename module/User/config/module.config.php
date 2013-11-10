<?php

return array(
    'data-fixture' => array(
        'User_fixture' => __DIR__ . '/../src/Fixture',
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'application_entities'
                )
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
//                'metadata_cache' => 'zend.static.local',
//                'query_cache'    => 'zend.static.local',
//                'result_cache'   => 'zend.static.local',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'create' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/registration',
                            'defaults' => array(
                                'controller'    => 'Index',
                                'action'        => 'create',
                            ),
                        ),
                    ),
                    'update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/update/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'User\Controller',
                                'controller'    => 'Index',
                                'action'        => 'update'
                            ),
                            'constraints' => array(
                                'id' => '[0-9]+'
                            )
                        ),
                    ),
                ),
            ),
            'user.login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Index',
                        'action'        => 'login',
                    ),
                ),
            ),
            'user.logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Index',
                        'action'        => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController'
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'RoleMapper' => 'User\Mapper\RoleMapper',
            'RoleForm' => 'User\Form\RoleForm',
            'UserMapper' => 'User\Mapper\UserMapper',
            'UserForm' => 'User\Form\UserForm'
        ),
        'factories' => array(
            'doctrine.cache.zend.static.local' => function ($sm) {
                return new \DoctrineModule\Cache\ZendStorageCache($sm->get('cache.static.local'));
            },
            'UserModel' => function($sm) {
                $model = new \User\Model\UserModel();
                $model->setServiceLocator($sm);
                $model->setForm($sm->get('UserForm'));
                $model->setMapper($sm->get('UserMapper'));
                return $model;
            },
            'RoleModel' => function($sm) {
                $model = new \User\Model\RoleModel();
                $model->setServiceLocator($sm);
                $model->setForm($sm->get('RoleForm'));
                $model->setMapper($sm->get('RoleMapper'));
                return $model;
            }
        ),
    ),
//    'view_helpers' => array(
//        'invokables' => array(
//            'bootstrapForm' => 'Application\View\Helper\NavLinkHelper'
//        )
//    ),
    'view_manager' => array(
        'template_map' => array(
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

