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
$vars = array();
$res = $dbo->query('SHOW VARIABLES', MsdDbFactory::ARRAY_ASSOC);
$numrows = @sizeof($res);
foreach ($res as $row) {
    $vars[$row['Variable_name']] = $row['Value'];
}

$filter = getPrefixArray($vars);
$tplSqlbrowserGeneralMysqlVariables = new MSDTemplate();
$tplSqlbrowserGeneralMysqlVariables->set_filenames(
    array(
        'tplSqlbrowserGeneralMysqlVariables' =>
            'tpl/sqlbrowser/general/mysqlVariables.tpl'
    )
);
$tplSqlbrowserGeneralMysqlVariables->assign_vars(
    array('SEL_FILTER' => Html::getOptionlist($filter, $selectedFilter))
);

if (count($vars) == 0) {
    $tpl->assign_block_vars('NO_VALUES', array());
} else {
    $i = 0;
    foreach ($vars as $name => $val) {
        if ($selectedFilter != '-1'
            && substr($name, 0, strlen($selectedFilter)) != $selectedFilter) {
                continue;
        }

        if (is_numeric($val)) {
            if (strpos($name, 'time') === false) {
                $val = String::formatNumber($val);
            } else {
                $val = getTimeFormat($val);
            }
        }

        $tplSqlbrowserGeneralMysqlVariables->assign_block_vars(
            'ROW',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'NR' => $i + 1,
                'VAR_NAME' => $name,
                'VAR_VALUE' => htmlspecialchars($val, ENT_COMPAT, 'UTF-8')
            )
        );
        $i++;
    }
}
