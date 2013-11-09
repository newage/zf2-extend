<?php

return array(
    'caches' => array(
        'cache.static.local' => array(
            'adapter' => 'apc',
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false,
                ),  
                'serializer',
            ),          
        ),
    ),
);
