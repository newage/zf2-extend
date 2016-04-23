<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

if (getenv('APPLICATION_ENV') == 'development' && file_exists('config/application.local.php')) {
    $config = require 'config/application.local.php';
} else {
    $config = require 'config/application.config.php';
}

// Setup autoloading
require 'vendor/autoload.php';

// Run the application!
Zend\Mvc\Application::init($config)->run();
