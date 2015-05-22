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
    'mysqldumper',
    //add more excluded files via: 'configFileName',
);

$myNl    = '<br />';
$verbose = true;
if (isset ($_SERVER['SESSIONNAME'])) {
    // called via cli - check verbose param
    $myNl    = "\n";
    $options = getopt('v::', array('verbose::'));
    if (isset($options['v'])) {
        $verbose = $options['v'];
    }
    if (isset($options['verbose'])) {
        $verbose = $options['verbose'];
    }
}

date_default_timezone_set('Europe/Berlin');
define('APPLICATION_PATH', realpath(dirname(__FILE__)));
chdir(APPLICATION_PATH);
include (APPLICATION_PATH . '/inc/functions.php');
include (APPLICATION_PATH . '/inc/mysql.php');
include ('language/en/lang.php');
// load default configuration
include ('work/config/mysqldumper.php');
GetLanguageArray();

$configFiles = get_config_filenames();
foreach ($configFiles as $configFile) {
    if (in_array($configFile, $excludedConfigurationFiles)) {
        continue;
    }
    if ($verbose) {
        echo 'Refreshing database list for configuration file: ' . $configFile . $myNl;
    }
    $config['config_file'] = $configFile;
    include ($config['paths']['config'] . $configFile . '.php');
    $out = '';
    if (isset($config['dbconnection']) && is_resource($config['dbconnection'])) {
        mysql_close($config['dbconnection']);
        $config['dbconnection'] = false;
    }
    SetDefault();
    if ($verbose) {
        echo str_replace("\n", $myNl, $out) . $myNl;
    }
}
