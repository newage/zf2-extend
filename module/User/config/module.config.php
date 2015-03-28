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
            'RoleModel' => 'User\Model\RoleModel',
            'RoleMapper' => 'User\Mapper\RoleMapper',
            'UserMapper' => 'User\Mapper\UserMapper',
            'UserModel' => 'User\Model\UserModel',
            'RegistrationForm' => 'User\Form\RegistrationForm',
            'LoginForm' => 'User\Form\LoginForm',
            'LoginService' => 'User\Service\LoginService',
            'RegistrationService' => 'User\Service\RegistrationService'
        ],
        'factories' => [
            'doctrine.cache.zend.static.local' => 'User\Factory\DoctrineCacheFactory',
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'template_map' => include __DIR__  .'/../template_map.php'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];