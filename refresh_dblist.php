<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

// This file reloads the database list and stores them in the configuration file
// this is useful when you are running the perl script to automatically backup
// databases and add/delete databases from time to time.
// Then this script can be called before the call for crondump.pl
// to uopdate the database list.
//
// Diese Datei ist nuetzlich, wenn regelmässig automatische Backups per
// Perlskript gemacht werden sich aber hin und wieder die Datenbankliste
// aendert. Dann kann dieses Skript vor der Datei crondump.pl
// aufgerufen werden, um die Datenbankliste zu aktualisieren.
//
// Konfigurationsdateien, die aktualisiert werden sollen
//
// configurations to update
// mehrere Dateien so angeben | enter more than one configurationfile like this
// $configurationfiles=array('mysqldumper','db2', ...);
/////////////////////////////////////////////////////////////////////////
$configurationfiles = array(
    'mysqldumper'
);
define('APPLICATION_PATH', realpath(dirname(__FILE__)));
chdir(APPLICATION_PATH);
include (APPLICATION_PATH . '/inc/functions/functions.php');
include (APPLICATION_PATH . '/inc/runtime.php');
include (APPLICATION_PATH . '/inc/mysql.php');
include (APPLICATION_PATH .'/inc/functions/functions_global.php');
include (APPLICATION_PATH .'/inc/classes/db/MsdDbFactory.php');
include (APPLICATION_PATH .'/inc/classes/helper/Html.php');

include (APPLICATION_PATH . '/language/en/lang.php');
$config['language'] = 'en';
$config['theme'] = "msd";
$config['files']['iconpath'] = 'css/' . $config['theme'] . '/icons/';

foreach ($configurationfiles as $c) {
    $config['config_file'] = $c;
    include (APPLICATION_PATH . '/'.$config['paths']['config'] . $c . '.php');
    getLanguageArray();
    $dbo = MsdDbFactory::getAdapter(
        $config['dbhost'],
        $config['dbuser'],
        $config['dbpass'],
        $config['dbport'],
        $config['dbsocket']
    );
    setDefaultConfig();
}
