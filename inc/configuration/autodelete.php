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

if (isset($_POST['save'])) {
    if (!is_array($config['auto_delete'])) {
        $config['auto_delete'] = array();
        $config['auto_delete']['activated'] = 0;
        $config['auto_delete']['max_backup_files'] = 3;
    }
    if (isset($_POST['auto_delete'])) {
        $config['auto_delete']['activated'] = (int) $_POST['auto_delete'];
    }
    if (isset($_POST['max_backup_files'])) {
        $config['auto_delete']['max_backup_files'] =
            (int) $_POST['max_backup_files'];
    }
}

$tplConfigurationAutodelete = new MSDTemplate();
$tplConfigurationAutodelete->set_filenames(
    array(
        'tplConfigurationAutodelete' => 'tpl/configuration/autodelete.tpl')
);

$tplConfigurationAutodelete->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'AUTODELETE_ENABLED_SELECTED' =>
            Html::getChecked($config['auto_delete']['activated'], 1),
        'AUTODELETE_DISABLED_SELECTED' =>
            Html::getChecked($config['auto_delete']['activated'], 0),
        'MAX_BACKUP_FILES' =>
            (int) $config['auto_delete']['max_backup_files'],
        'MAX_BACKUP_FILES_DISABLED' =>
            Html::getDisabled($config['auto_delete']['activated'], 0))
);