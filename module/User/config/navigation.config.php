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
                        'label' => 'User',
                        'route' => 'user',
                        'pages' => [
                            [
                                'label' => 'Registration',
                                'route' => 'user/registration'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];