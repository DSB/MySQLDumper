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
include ('./inc/define_icons.php');
$hta = '';

$tplHomeProtectionEdit = new MSDTemplate();
$tplHomeProtectionEdit->set_filenames(
    array('tplHomeProtectionEdit' => 'tpl/home/protection_edit.tpl')
);

if (isset($_POST['hta_content'])) {
    if ($fp = fopen('./.htaccess', 'w')) {
        if (fwrite($fp, $_POST['hta_content'])) {
            $tplHomeProtectionEdit->assign_block_vars(
                'HTA_SAVED_SUCCESSFULLY', array()
            );
        } else {
            $tplHomeProtectionEdit->assign_block_vars(
                'HTA_SAVED_UNSUCCESSFULLY', array()
            );
        }
        fclose($fp);
    } else {
        $tplHomeProtectionEdit->assign_block_vars(
            'ERROR_OPENING_HTACCESS', array()
        );
    }
}

if (file_exists('./.htaccess') && is_readable('./.htaccess')) {
    $hta = implode('', file('./.htaccess'));
} else {
    $tplHomeProtectionEdit->assign_block_vars(
        'ERROR_OPENING_HTACCESS', array()
    );
}

$tplHomeProtectionEdit->assign_vars(
    array(
        'HTA_CONTENT' => htmlspecialchars($hta, ENT_COMPAT, 'UTF-8'),
        'ICON_SEARCH' => $icon['search'],
        'ICON_OPEN_FILE' => $icon['small']['open_file'],
        'ICON_SAVE' => $icon['small']['save'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_ARROW_LEFT' => $icon['arrow_left']
    )
);
