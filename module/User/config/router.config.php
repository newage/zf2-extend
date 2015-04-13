<?php

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'update' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/update/:id',
                            'defaults' => [
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'Index',
                                'action' => 'update'
                            ],
                            'constraints' => [
                                'id' => '[0-9]+'
                            ]
                        ]
                    ]
                ]
            ],
            'registration' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/registration',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'registration'
                    ]
                ]
            ],
            'login' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'login'
                    ]
                ]
            ],
            'logout' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'logout'
                    ]
                ]
            ],
            'forgot' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/forgot',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'forgot'
                    ]
                ]
            ],
            'restore' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/restore/:hash',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'restore'
                    ],
                    'constraints' => [
                        'hash' => '[\w\d]{40}'
                    ]
                ]
            ]
        ]
    ]
];
