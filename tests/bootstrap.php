<?php
// set up test environment
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('MSD_VERSION') || define('MSD_VERSION', ' 2.0.0');
defined('WORK_PATH') || define('WORK_PATH', realpath(dirname(__FILE__) . DS . '../'. DS . 'work'));
defined('CONFIG_PATH') || define('CONFIG_PATH', WORK_PATH . DS . 'config');

// Define path to application directory
defined('APPLICATION_PATH') || define(
    'APPLICATION_PATH', realpath(
        dirname(__FILE__) . DS . '..' . DS . 'application')
);

// Define path to test directory
defined('TEST_PATH') || define(
    'TEST_PATH', realpath(dirname(__FILE__) . '/')
);

// Define application environment
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', 'testing');
}
// Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/../application'),
            realpath(APPLICATION_PATH . '/../library'),
            realpath(APPLICATION_PATH . '/views/helpers'),
            get_include_path()
        )
    )
);


require_once 'Zend/Application.php';
require_once 'PHPUnit/Autoload.php';
require_once 'ControllerTestCase.php';
require_once 'Testhelper.php';
Testhelper::setUp();

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();
clearstatcache();

