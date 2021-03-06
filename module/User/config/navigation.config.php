<?php

return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home',
                'pages' => [
                    [
                        'label' => 'Login',
                        'route' => 'login',
                    ],
                    [
                        'label' => 'Registration',
                        'route' => 'registration'
                    ],
                    [
                        'label' => 'User',
                        'route' => 'user',
                        'pages' => [
                            [
                                'label' => 'Update',
                                'route' => 'user/update'
                            ]
                        ]
                    ],
                    [
                        'label' => 'Restore password',
                        'route' => 'forgot',
                        'pages' => [
                            [
                                'label' => 'Change password',
                                'route' => 'restore'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
