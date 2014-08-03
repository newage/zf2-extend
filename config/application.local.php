<?php
return array(
    'modules' => array(
        'ZFTool',
        'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'Application',
    ),
    
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
        ),
        
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php'
        ),
        
        'config_cache_enabled' => false
    )
);
