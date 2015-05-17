<?php
return [
    'caches' => [
        'cache.static.local' => [
            'adapter' => 'apc',
            'plugins' => [
                'exception_handler' => [
                    'throw_exceptions' => false
                ],
                'serializer'
            ]
        ]
    ],
    'controller_plugins' => [
        'invokables' => [
            'messenger' => 'Core\Mvc\Controller\Plugin\Messenger'
        ]
    ],
    'view_helpers' => [
        'factories' => [
            'messenger' => 'Core\View\Helper\Factory\MessengerFactory'
        ]
    ]
];
