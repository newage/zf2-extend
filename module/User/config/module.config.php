<?php

return [
    'doctrine_factories' => array(
        'authenticationadapter' => 'User\Factory\Authentication\Adapter',
    ),
    'data-fixture' => [
        'User_fixture' => __DIR__ . '/../src/Fixture'
    ],
    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'User\Entity\User',
                'identity_property' => 'identifier',
                'credential_property' => 'password'
            ],
        ],
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'application_entities'
                ]
            ]
        ],
        'configuration' => [
            'orm_default' => []
            // 'metadata_cache' => 'zend.static.local',
            // 'query_cache' => 'zend.static.local',
            // 'result_cache' => 'zend.static.local',
        ]
    ],
    'controllers' => [
        'invokables' => [
            'User\Controller\Index' => 'User\Controller\IndexController'
        ]
    ],
    'service_manager' => [
        'invokables' => [
            /* Mappers */
            'RoleMapper' => 'User\Mapper\RoleMapper',
            'UserMapper' => 'User\Mapper\UserMapper',
            /* Events */
            'SendEmailEvent' => 'User\Event\SendEmail',
        ],
        'factories' => [
            'doctrine.cache.zend.static.local' => 'User\Factory\DoctrineCacheFactory',
            'Zend\Authentication\AuthenticationService' => 'User\Factory\Authentication\Service',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'RoleModel' => 'User\Factory\RoleModelFactory',
            'UserModel' => 'User\Factory\UserModelFactory',
            'RegistrationService' => 'User\Factory\RegistrationServiceFactory',
            'LoginService' => 'User\Factory\LoginServiceFactory',
            'ForgotService' => 'User\Factory\ForgotServiceFactory',
            'RestoreService' => 'User\Factory\RestoreServiceFactory',
        ]
    ],
    'view_manager' => [
        'template_map' =>  require __DIR__  .'/../template_map.php'
    ]
];
