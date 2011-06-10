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
$tplSqlbrowserGeneralProcess = new MSDTemplate();
$tplSqlbrowserGeneralProcess->set_filenames(
    array('tplSqlbrowserGeneralProcess' => 'tpl/sqlbrowser/general/process.tpl')
);

$killid = 0;
if (isset($_GET['killid']) && $_GET['killid'] > 0) {
    $killid = (int) $_GET['killid'];
    if (isset($_POST['killid'])) intval($killid = $_POST['killid']);
    $wait = (isset($_POST['wait'])) ? $_POST['wait'] : 0;
    if ($wait == 0) {
        $tplSqlbrowserGeneralProcess->assign_block_vars(
            'KILL_STARTED', array('KILL_ID' => $killid)
        );
        $wait = $config['refresh_processlist'];
        try
        {
            $ret = $dbo->query('KILL ' . $_GET['killid'], MsdDbFactory::SIMPLE);
        }
        catch (Exception $e)
        {
            $tplSqlbrowserGeneralProcess->assign_block_vars(
                'KILL_ERROR',
                array('MESSAGE' => '('.$e->getCode().') '.$e->getMessage())
            );
        }
    } else {
        $tplSqlbrowserGeneralProcess->assign_block_vars(
            'KILL_WAIT',
            array(
                'KILL_ID' => $killid,
                'WAIT_TIME' => $wait
            )
        );
        $wait += $config['refresh_processlist'];
    }
}

$res = $dbo->query('SHOW FULL PROCESSLIST', MsdDbFactory::ARRAY_NUMERIC);
$numrows = (int) @sizeof($res);
if ($numrows == 0) {
    $tplSqlbrowserGeneralProcess->assign_block_vars('NO_PROCESS', array());
} else {
    $processFound = false;
    foreach ($res as $row) {
        if ($row[0] == $killid) {
            $processFound = true;
            if ($row[4] == "Killed") $killid = 0;
        }

        $tplSqlbrowserGeneralProcess->assign_block_vars(
            'ROW',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'NR' => $i + 1,
                'ID' => $row[0],
                'USER' => $row[1],
                'HOST' => $row[2],
                'DB' => $row[3],
                'QUERY' => $row[4],
                'TIME' => $row[5],
                'STATE' => $row[6],
                'INFO' => $row[7]
            )
        );
        if ($killid == 0) {
            $tplSqlbrowserGeneralProcess->assign_block_vars(
                'ROW.KILL', array()
            );
        }
    }
    if (!$processFound) {
        $killid = 0;
    }
}

$tplSqlbrowserGeneralProcess->assign_vars(
    array(
        'REFRESHTIME' => $config['refresh_processlist'],
        'REFRESHTIME_MS' => $config['refresh_processlist'] * 1000,
        'ICON_DELETE' => $icon['kill_process'],
        'KILL_ID' => $killid
    )
);
