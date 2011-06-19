<?php
define('DS', DIRECTORY_SEPARATOR);
define('WORK_PATH', realpath(dirname(__FILE__) . DS. '..' . DS . 'work'));

// Define path to application directory
defined('APPLICATION_PATH') || define(
    'APPLICATION_PATH', realpath(
        dirname(__FILE__) . DS . '..' . DS . 'application'
    )
);

defined('LIBRARY_PATH') || define(
    'LIBRARY_PATH', realpath(
        dirname(__FILE__) . DS . '..' . DS . 'library'
    )
);

// Define application environment
if (!defined('APPLICATION_ENV')) {
    $appEnvironment = getenv('APPLICATION_ENV');
    if ($appEnvironment !== false) {
        define('APPLICATION_ENV', $appEnvironment);
    } else {
        define('APPLICATION_ENV', 'production');
    }
    unset($appEnvironment);
}

// Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR, array(realpath(
            APPLICATION_PATH . DS . '..' . DS .'library'
        ),
        get_include_path())
    )
);

if (APPLICATION_ENV == 'development' && !class_exists('Debug')) {
    include_once 'Debug.php';
}


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . DS . 'configs' . DS .'application.ini'
);
$application->bootstrap()
            ->run();