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

if (!defined('MSD_VERSION')) die('No direct access.');
include ('./inc/functions/functions_dump.php');
include ('./inc/functions/functions_sql.php');
include ('./inc/define_icons.php');

if ($action == '') {
    //first call -> clear arrays with values from last run
    $_SESSION['dump'] = array();
    $_SESSION['log'] = array();
    $_SESSION['log']['actions'] = array();
    $_SESSION['log']['errors'] = array();
    $_SESSION['log']['files_created'] = array();
    $dump['comment'] = '';
    $action = 'prepare_dump';
}
if ($action == 'prepare_dump') include ('./inc/dump/dump_prepare.php');
if ($action == 'select_tables') include ('./inc/dump/select_tables.php');
if ($action == 'do_dump') include ('./inc/dump/do_dump.php');
if ($action == 'done') include ('./inc/dump/dump_finished.php');
$_SESSION['dump'] = $dump;
