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
    ]
];
