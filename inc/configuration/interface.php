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
//define position-array for notification window
$positions = array(
    'tl' => $lang['L_POSITION_TL'],
    'tc' => $lang['L_POSITION_TC'],
    'tr' => $lang['L_POSITION_TR'],
    'ml' => $lang['L_POSITION_ML'],
    'mc' => $lang['L_POSITION_MC'],
    'mr' => $lang['L_POSITION_MR'],
    'bl' => $lang['L_POSITION_BL'],
    'bc' => $lang['L_POSITION_BC'],
    'br' => $lang['L_POSITION_BR']
);

if (isset($_POST['save'])) {
    if (isset($_POST['interface_server_caption'])) {
        $config['interface_server_caption'] = 1;
    } else {
        $config['interface_server_caption'] = 0;
    }
    if (isset($_POST['interface_server_caption_position_1'])) {
        $config['interface_server_caption_position'] = 1;
    } else {
        $config['interface_server_caption_position'] = 0;
    }
    if (isset($_POST['sqlboxsize'])) {
        $config['interface_sqlboxsize'] = (int) $_POST['sqlboxsize'];
    }
    if (isset($_POST['theme'])) {
        $config['theme'] =(string) $_POST['theme'];
    }
    // make sure that the theme exists! If not fall back to standard theme
    if (!is_dir('./css/' . $config['theme'])
        || !is_readable('./css/' . $config['theme'])) {
            $config['theme'] = 'msd';
    }
    if (isset($_POST['notification_position'])) {
        $config['notification_position'] = $_POST['notification_position'];
    }
    if (isset($_POST['interface_table_compact'])) {
        $config['interface_table_compact']
            = (int) $_POST['interface_table_compact'];
    };
    if (isset($_POST['resultsPerPage'])) {
        $config['resultsPerPage'] = (int) $_POST['resultsPerPage'];
    }
    if (isset($_POST['refresh_processlist'])) {
        $config['refresh_processlist'] = (int) $_POST['refresh_processlist'];
    }
    if ($config['refresh_processlist'] < 2) {
        $config['refresh_processlist'] = 2;
    }
}

$tplConfigurationInterface = new MSDTemplate();
$tplConfigurationInterface->set_filenames(
    array('tplConfigurationInterface' => 'tpl/configuration/interface.tpl')
);

$tplConfigurationInterface->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'SEL_LANGUAGES' => getLanguageCombo(),
        'LINK_DOWNLOAD_LANGUAGE_PACKS' =>
            'http://forum.mysqldumper.de/downloads.php?cat=9',
        'LANGUAGE' => $config['language'],
        'SERVER_CAPTION' => $config['interface_server_caption'],
        'INTERFACE_SERVER_CAPTION_ACTIVATED' =>
            Html::getChecked($config['interface_server_caption'], 1),
        'INTERFACE_SERVER_CAPTION_DISABLED' =>
            Html::getDisabled($config['interface_server_caption'], 0),
        'SERVER_CAPTION_POS_MAINFRAME_SELECTED' =>
            Html::getChecked($config['interface_server_caption_position'], 1),
        'SERVER_CAPTION_POS_MENUE_SELECTED' =>
            Html::getChecked($config['interface_server_caption_position'], 0),
        'SEL_THEME' => getThemes(),
        'LINK_DOWNLOAD_THEMES' =>
            'http://forum.mysqldumper.de/downloads.php?cat=3',
        'SQLBOX_HEIGHT' => intval($config['interface_sqlboxsize']),
        'RESULTS_PER_PAGE' => intval($config['resultsPerPage']),
        'SEL_NOTIFICATION_POSITION' =>
            Html::getOptionlist($positions, $config['notification_position']),
        'REFRESH_PROCESSLIST' => (int) $config['refresh_processlist'],
        'SQL_GRID_TYPE_COMPACT_SELECTED' =>
            $config['interface_table_compact'] == 1 ? ' checked="checked"' : '',
        'SQL_GRID_TYPE_NORMAL_SELECTED' =>
            $config['interface_table_compact'] == 0 ? ' checked="checked"' : ''
    )
);
