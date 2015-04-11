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
                'type' => 'Segment',
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
                'type' => 'Segment',
                'options' => [
                    'route' => '/forgot',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'forgot'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'restore' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/:hash',
                            'defaults' => [
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'Index',
                                'action' => 'restore'
                            ],
                            'constraints' => [
                                'hash' => '.{32,32}'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
