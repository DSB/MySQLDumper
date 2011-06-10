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
$selectedFilter = -1;
if (isset($_POST['filter_selected'])) {
    $selectedFilter = $_POST['filter_selected'];
}
$res = $dbo->query('SHOW GLOBAL STATUS', MsdDbFactory::ARRAY_ASSOC);
foreach ($res as $row) {
    $status[$row['Variable_name']] = $row['Value'];
}

$filter = getPrefixArray($status);
// values that will be formatted as times
$timeValues = array('Uptime', 'Uptime_since_flush_status');

$tplSqlbrowserGeneralStatus = new MSDTemplate();
$tplSqlbrowserGeneralStatus->set_filenames(
    array(
        'tplSqlbrowserGeneralStatus' => 'tpl/sqlbrowser/general/status.tpl'
    )
);

if ($selectedFilter != '-1') {
    $query = 'SHOW GLOBAL STATUS LIKE \'' . $selectedFilter . '_%\'';
    $res = $dbo->query($query, MsdDbFactory::ARRAY_ASSOC);
}
if (@sizeof($res) == 0) {
    $tpl->assign_block_vars('NO_STATUS', array());
} else {
    if (count($filter) > 0) {
        $tplSqlbrowserGeneralStatus->assign_block_vars(
            'FILTER',
            array(
                'SEL_FILTER' => Html::getOptionlist($filter, $selectedFilter)
            )
        );
    }
    $i = 0;
    foreach ($status as $key => $val) {
        if ($selectedFilter != '-1'
            && substr($key, 0, strlen($selectedFilter)) != $selectedFilter) {
                continue;
        }

        if (in_array($key, $timeValues)) {
            $val = getTimeFormat($val);
        } else {
            $val = String::formatNumber($val);
        }

        $tplSqlbrowserGeneralStatus->assign_block_vars(
            'ROW',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'NR' => $i + 1,
                'VAR_NAME' => $key,
                'VAR_VALUE' => $val
            )
        );
        $i++;
    }
}
