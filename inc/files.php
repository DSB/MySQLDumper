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

include ('./inc/functions/functions_files.php');
if (isset($_GET['action']) && $_GET['action'] == 'dl') {
    $download = true;
    include ('./inc/filemanagement/file_download.php');
}
include ('./inc/functions/functions_sql.php');
$msg = '';
$dump = array();
$toolboxstring = '';
$dbactive = (isset($_GET['dbactive'])) ? $_GET['dbactive'] : $config['db_actual'];
if (isset($_POST['dbactive'])) {
    $dbactive = $_POST['dbactive'];
}
if ($action == 'restore' || isset($_POST['restore_tbl'])
    || isset($_POST['restore'])) {
        include ('./inc/restore/restore_prepare.php');
}
if (isset($_POST['upload'])) {
    include ('./inc/filemanagement/file_upload.php');
}
if ($action == 'files' || $action == '') {
    include ('./inc/filemanagement/files.php');
}
if ($action == 'convert') {
    include ('./inc/filemanagement/converter.php');
}
