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
if (!defined('MSD_VERSION')) {
    die('No direct access.');
}
getSqlLibrary();
if (isset($_POST['save'])) {
    if (count($databases) > 0) {
        $i = 0;
        foreach ($databases as $dbName => $val) {
            $databases[$dbName]['prefix'] = '';
            if (isset($_POST['dbpraefix_' . $i])) {
                $databases[$dbName]['prefix'] = $_POST['dbpraefix_' . $i];
            }
            $databases[$dbName]['command_before_dump'] = '';
            if (!empty($_POST['command_before_' . $i])) {
                $databases[$dbName]['command_before_dump'] =
                    getQueryFromSqlLibrary($_POST['command_before_' . $i]);
            }
            $databases[$dbName]['command_after_dump'] = '';
            if (!empty($_POST['command_after_' . $i])) {
                $databases[$dbName]['command_after_dump'] =
                    getQueryFromSqlLibrary($_POST['command_after_' . $i]);
            }
            if (isset($_POST['db_multidump_' . $i])
                && $_POST['db_multidump_' . $i] == "db_multidump_$i") {
                $databases[$dbName]['dump'] = 1;
            } else {
                $databases[$dbName]['dump'] = 0;
            }
            $i++;
        }
    }
    if ($config['dbhost'] != $_POST['dbhost']
        || $config['dbuser'] != $_POST['dbuser']
        || $config['dbpass'] != $_POST['dbpass']
        || $config['dbport'] != $_POST['dbport']
        || $config['dbsocket'] != $_POST['dbsocket']) {
        //neue Verbindungsparameter
        $blendInConnectionParams = true;
        //alte Parameter sichern
        $old['dbhost'] = $config['dbhost'];
        $old['dbuser'] = $config['dbuser'];
        $old['dbpass'] = $config['dbpass'];
        $old['dbport'] = $config['dbport'];
        $old['dbsocket'] = $config['dbsocket'];
        //neu setzen
        $config['dbhost'] = $_POST['dbhost'];
        $config['dbuser'] = $_POST['dbuser'];
        $config['dbpass'] = $_POST['dbpass'];
        $config['dbport'] = $_POST['dbport'];
        $config['dbsocket'] = $_POST['dbsocket'];
        $dbo = MsdDbFactory::getAdapter(
            $config['dbhost'],
            $config['dbuser'],
            $config['dbpass'],
            $config['dbport'],
            $config['dbsocket']
        );
        // try to connect with new params
        $res = $dbo->dbConnect();
        if ($res === true) {
            // ok - get list of databases
            $dbo->getDatabases();
            setDefaultConfig();
        } else {
            //something went wrong - resume old values
            $config['dbhost'] = $old['dbhost'];
            $config['dbuser'] = $old['dbuser'];
            $config['dbpass'] = $old['dbpass'];
            $config['dbport'] = $old['dbport'];
            $config['dbsocket'] = $old['dbsocket'];
            $msg .= '<p class="error">' . $lang['L_WRONG_CONNECTIONPARS'] . ': ' . $res . '</p>';
            $saveConfig = false;
            $dbo = MsdDbFactory::getAdapter(
                $config['dbhost'],
                $config['dbuser'],
                $config['dbpass'],
                $config['dbport'],
                $config['dbsocket']
            );
        }
    }
    // manual adding of a database
    if ($_POST['add_db_manual'] > '') {
        $saveConfig = false;
        $blendInConnectionParams = true;
        $dbToAdd = trim($_POST['add_db_manual']);
        $found = false;
        // Check if we already have this one in our db list
        if (isset($databases[$dbToAdd])) {
            $addDbMessage = sprintf($lang['L_DB_IN_LIST'], $dbToAdd);
        } else {
            $dbo = MsdDbFactory::getAdapter(
                $config['dbhost'],
                $config['dbuser'],
                $config['dbpass'],
                $config['dbport'],
                $config['dbsocket']
            );
            try {
                $dbo->selectDb($dbToAdd, true);
                addDatabaseToConfig($dbToAdd);
                $saveConfig = true;
            } catch (Exception $e){
                $addDbMessage = $lang['L_ERROR'] . ': (' . $e->getCode() . ') ';
                $addDbMessage .= $e->getMessage();
            }
        }
    }
}
$tplConfigurationDatabases = new MSDTemplate();
$tplConfigurationDatabases->set_filenames(
    array('tplConfigurationDatabases' => 'tpl/configuration/databases.tpl')
);
$tplConfigurationDatabases->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'DB_HOST' => $config['dbhost'],
        'DB_USER' => $config['dbuser'],
        'DB_PASS' => $config['dbpass'],
        'DB_PORT' => $config['dbport'],
        'DB_SOCKET' => $config['dbsocket'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_DOWN' => $icon['arrow_down'],
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'])
);
if (isset($addDbMessage) && $addDbMessage > '')
    $tplConfigurationDatabases->assign_block_vars(
        'MANUAL_DB_ADD', array('MESSAGE' => $addDbMessage)
);
    //Wenn Datenbanken vorhanden sind
if (count($databases) > 0) {
    $dbCount = count($databases);
    $tplConfigurationDatabases->assign_block_vars(
        'DBS', array('DB_COUNT' => $dbCount)
    );
    $i = 0;
    foreach ($databases as $dbName => $val) {
        if (!isset($val['dump'])) {
            $val['dump'] = 0;
        }
        if (!isset($val['prefix'])) {
            $val['prefix'] = '';
        }
        $rowclass = $i % 2 ? 'dbrow' : 'dbrow1';
        if ($dbName == $config['db_actual']) {
            $rowclass = 'dbrowsel';
        }
        $tplConfigurationDatabases->assign_block_vars(
            'DBS.ROW', array(
                'ROWCLASS' => $rowclass,
                'ID' => $i,
                'NR' => $i + 1,
                'DB_NAME' => $dbName,
                'DB_MULTIDUMP_ENABLED' => Html::getChecked($val['dump'], 1),
                'DB_PREFIX' => $val['prefix'],
                'COMMAND_BEFORE_BACKUP_COMBO' => getCommandDumpComboBox(0, $i, $dbName),
                'COMMAND_AFTER_BACKUP_COMBO' => getCommandDumpComboBox(1, $i, $dbName))
        );
        $i++;
    }
} else {
    $tplConfigurationDatabases->assign_block_vars('NO_DB', array());
}
