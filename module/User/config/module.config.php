<?php

return [
    'data-fixture' => [
        'User_fixture' => __DIR__ . '/../src/Fixture'
    ],
    'doctrine' => [
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
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'RoleModel' => 'User\Factory\RoleModelFactory',
            'UserModel' => 'User\Factory\UserModelFactory',
            'RegistrationService' => 'User\Factory\RegistrationServiceFactory',
            'LoginService' => 'User\Factory\LoginServiceFactory',
        ]
    ],
    'view_manager' => [
        'template_map' =>  require __DIR__  .'/../template_map.php'
    ]
];