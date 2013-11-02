<?php
return array(
    'modules' => array(
        'ZFTool',
        'ConsoleTools',
        'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'Application',
        'User'
    ),

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),

        'config_cache_enabled' => false,
    ),
);
