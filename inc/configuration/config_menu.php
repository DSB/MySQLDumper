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
$tplConfigurationConfigMenu = new MSDTemplate();
$tplConfigurationConfigMenu->set_filenames(
    array(
        'tplConfigurationConfigMenu' => 'tpl/configuration/config_menu.tpl'
    )
);

$msdMode = $lang['L_MODE_EXPERT'];
if ($config['msd_mode'] == 0) {
    $msdMode = $lang['L_MODE_EASY'];
}
$tplConfigurationConfigMenu->assign_vars(
    array(
        'CONFIGURATION_NAME' => $config['config_file'],
        'ICON_SAVE' => $icon['small']['save'],
        'ICON_OPEN_FILE' => $icon['small']['open_file'],
        'MSD_MODE' => $msdMode
    )
);
