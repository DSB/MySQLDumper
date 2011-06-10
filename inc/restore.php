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

include ('./inc/functions/functions_restore.php');
include ('./inc/functions/functions_files.php');
include ('./inc/define_icons.php');
if ($action == 'done') {
    include('./inc/restore/restore_finished.php');
} else {
    include('./inc/restore/restore_start.php');
}