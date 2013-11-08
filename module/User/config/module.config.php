<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'xcache',
                'paths' => array(__DIR__ . '/../src/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'application_entities'
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache' => 'zend.static.local',
                'query_cache'    => 'zend.static.local',
                'result_cache'   => 'zend.static.local',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'doctrine.cache.zend.static.local' => function ($sm) {
                return new \DoctrineModule\Cache\ZendStorageCache($sm->get('cache.static.local'));
            },
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'application' => array(
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
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

