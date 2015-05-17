<?php
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'Application',
        'User'
    ),
    
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
        ),
        
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local,test}.php'
        ),
        
        'config_cache_enabled' => false
    )
);
