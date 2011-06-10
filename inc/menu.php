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

include ('./language/lang_list.php');
$langOld = $config['language'];

// define template
$tplMenu = new MSDTemplate();
$tplMenu->set_filenames(array('tplMenu' => 'tpl/menu/menu.tpl'));

$tplMenu->assign_vars(
    array(
        'PAGE' => $p,
        'ACTION_SET' => $action > '' ? '&amp;action=' . $action : '',
        'MSD_VERSION' => MSD_VERSION . ' (' . MSD_VERSION_SUFFIX . ')',
        'CONFIG_HOMEPAGE' => $config['homepage'],
        'CONFIG_THEME' => $config['theme'],
        'CONFIG_FILE' => $config['config_file']
    )
);

// set picture according to mode
if ($config['msd_mode'] == 0) {
    $tplMenu->assign_block_vars('MSD_MODE_EASY', array());
} else {
    $tplMenu->assign_block_vars('MSD_MODE_EXPERT', array());
}

if (isset($_POST['selected_config']) || isset($_GET['config'])) {
    // Configuration was switched in menu frame
    if (isset($_POST['selected_config'])) {
        $newConfig = $_POST['selected_config'];
    }
    if (is_readable($config['paths']['config'] . $newConfig . '.php')) {
        clearstatcache();
        unset($databases);
        $databases = array();
        if (getConfig($newConfig)) {
            $config['config_file'] = $newConfig;
            $_SESSION['config_file'] = $newConfig;
            $tplMenu->assign_vars(
                array('CONFIG_FILE' => urlencode($newConfig))
            );
            $p = 'config'; // switch to configuration page
            // hand over message to config page
            $msg = sprintf($lang['L_CONFIG_LOADED'], $config['config_file']);
            $msg = Html::getOkMsg($msg);
        }
    }
}

// show Server caption?
if ($config['interface_server_caption'] == 1) {
    $tplMenu->assign_block_vars(
        'SHOW_SERVER_CAPTION',
        array(
            'KIND' => $config['interface_server_caption_position'],
            'LINK' => getServerProtocol() . $_SERVER['SERVER_NAME'],
            'NAME' => $_SERVER['SERVER_NAME']
        )
    );
}
if (isset($_GET['dbrefresh'])) {
    // remember the name of the selected database
    $oldDbName = $config['db_actual'];
    if (isset($_GET['db_name'])) {
        // new db created -> switch to it
        $oldDbName = base64_decode($_GET['db_name']);
    }
    setDefaultConfig();
    // lets lookup if the old database is still there
    if (isset($databases[$oldDbName])) {
        $dbo->selectDb($oldDbName);
    } else {
        $dbo->selectDb($dbo->databases[0]);
    }
    ksort($databases);
    $_SESSION['databases'] = $databases;
}

if (isset($_POST['dbindex']) || isset($_GET['dbindex'])) {
    if (isset($_POST['dbindex'])) {
        $dbName = $_POST['dbindex'];
    }
    if (isset($_GET['dbindex'])) {
        $dbName = $_GET['dbindex'];
    }
    $dbName = base64_decode($dbName);
    $config['db_actual'] = $dbName;
    $dbo->selectDb($dbName);
    saveConfig();
}

$tplMenu->assign_var('GET_FILELIST', getConfigFilelist($config['config_file']));

if (count($databases) > 0) {
    // show menu items related to databases
    $tplMenu->assign_block_vars('MAINTENANCE', array());
    $tplMenu->assign_vars(
        array('DB_ACTUAL_URLENCODED' => base64_encode($config['db_actual']))
    );
    ksort($databases);
    $tplMenu->assign_block_vars('DB_LIST', array());
    foreach ($databases as $dbName => $val) {
        $selected = Html::getSelected($dbName, $config['db_actual']);
        $tplMenu->assign_block_vars(
            'DB_LIST.DB_ROW', array(
                'ID' => base64_encode($dbName),
                'NAME' => $dbName,
                'SELECTED' => $selected)
        );
    }
} else {
    $tplMenu->assign_block_vars('NO_DB_FOUND', array());
}
$tplMenu->assign_vars(array('TIMESTAMP' => time()));

if (count($databases) == 0) {
    $tplMenu->assign_block_vars('DB_NAME_TRUE', array());
} else {
    $tplMenu->assign_block_vars('DB_NAME_FALSE', array());
}
// PayPal-Button - show German or English one?
if (in_array($config['language'], array('de', 'de_du', 'ch'))) {
    $tplMenu->assign_block_vars('PAYPAL_DEUTSCH', array());
} else {
    $tplMenu->assign_block_vars('PAYPAL_ENGLISH', array());
}

// set class for active menuitem
$filesActive = ($p == 'files' && $action != 'dump' && $action != 'restore');
$restoreActive = $p == 'restore' || $action =='restore';
$tplMenu->assign_vars(
    array(
        'HOME_ACTIVE' => $p == 'home' ? ' class="active"' : '',
        'CONFIG_ACTIVE' => $p == 'config' ? ' class="active"' : '',
        'DUMP_ACTIVE' => $p == 'dump' ? ' class="active"' : '',
        'RESTORE_ACTIVE' => $restoreActive ? ' class="active"' : '',
        'FILES_ACTIVE' =>  $filesActive ? ' class="active"' : '',
        'SQL_ACTIVE' => $p == 'sql' ? ' class="active"' : '',
        'LOG_ACTIVE' => $p == 'log' ? ' class="active"' : ''
    )
);
