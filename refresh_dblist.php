<?php
/**
 * Loads all configuration files and refreshes the database list.
 *
 * Add configuration file names to array $excludedConfigurationFiles to skip configurations.
 */
error_reporting(E_ALL ^ ~E_NOTICE);
$verbose = true;
/**
 * Build exclude array with configuration files that should be skipped
 */
$excludedConfigurationFiles = array(
    //'mysqldumper',
    //add more excluded files by adding their name
);

$verbose = true;
if (PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR'])) {
    // called via cli - check verbose param
    define('NEWLINE', "\n");
    $options = getopt('v::', array('verbose::'));
    $verbose = isset($options['verbose']) || isset($options['v']) ? true : false;
} else {
    define('NEWLINE', '<br />');
}

date_default_timezone_set('Europe/Berlin');
define('APPLICATION_PATH', __DIR__);
chdir(APPLICATION_PATH);
include(APPLICATION_PATH . '/inc/functions.php');
include(APPLICATION_PATH . '/inc/mysql.php');
include('language/en/lang.php');
// load default configuration
include('work/config/mysqldumper.php');
GetLanguageArray();

$configFiles = get_config_filenames();
foreach ($configFiles as $configFile) {
    if (in_array($configFile, $excludedConfigurationFiles)) {
        continue;
    }
    output('Refreshing database list for configuration file: ' . $configFile, $verbose);
    $config['config_file'] = $configFile;
    include($config['paths']['config'] . $configFile . '.php');
    $out = '';
    if (isset($config['dbconnection']) && is_resource($config['dbconnection'])) {
        ((is_null($___mysqli_res = mysqli_close($config['dbconnection']))) ? false : $___mysqli_res);
        $config['dbconnection'] = false;
    }
    SetDefault();
    output($out, $verbose);
}

/**
 * @param string  $message
 * @param boolean $verbose
 */
function output($message, $verbose)
{
    if ($verbose) {
        $message = str_replace("\n", NEWLINE, $message);
        echo $message . NEWLINE;
    }
}
