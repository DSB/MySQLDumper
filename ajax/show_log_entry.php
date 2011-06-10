<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: $
* @author           $Author$
 * @lastmodified    $Date$
 */
$error = false;
chdir('./../');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/functions/functions_global.php');
include ('./inc/mysql.php');
include ('./inc/classes/db/MsdDbFactory.php');
include ('./inc/classes/helper/String.php');
include ('./inc/classes/helper/Html.php');
include ('./inc/classes/Log.php');
obstart();
include ('./inc/define_icons.php');
include ('./lib/template.php');

$logType = (isset($_GET['log'])) ? $_GET['log'] : Log::PHP;
$revers = (isset($_GET['revers'])) ? $_GET['revers'] : 1;
$offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
$entriesShown = 25;

// define template
$tplLog = new MSDTemplate();
$tplLog->set_filenames(array('tplLog' => 'tpl/log/log_ajax.tpl'));

// get log filename to show
$lfile = Log::getLogfile($logType);
$tplLog->assign_vars(
    array(
        'ICON_SORT' => $revers == 0 ? $icon['arrow_up'] : $icon['arrow_down'],
        'SORT_ORDER' => $revers == 0 ? 1 : 0,
        'LOG' => str_replace($config['paths']['log'], '', $lfile))
);

$tplLog->assign_vars(
    array(
        'LOG_TYPE' => $logType,
        'REVERS' => $revers)
);

if (file_exists($lfile)) {
    $lines = ($config['logcompression'] == 1) ? gzfile($lfile) : file($lfile);
    if ($revers == 1) {
        $lines = array_reverse($lines);
    }
    $i = 1;
    $entriesTotal = count($lines);
    foreach ($lines as $index => $val) {
        if ($index >= $offset * $entriesShown
            && $index < ($offset + 1) * $entriesShown) {
            // strip html in Perl-Log
            $val = strip_tags($val, '<br>');
            $timestamp = substr($val, 0, 19);
            $message = substr($val, 20);
            if ($revers == 0) {
                $nr = String::formatNumber($offset * $entriesShown + $i);
            } else {
                $nr=  String::formatNumber($entriesTotal - $index);
            }
            $tplLog->assign_block_vars(
                'LINE',
                array(
                    'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                    'NR' => $nr,
                    'TIMESTAMP' => $timestamp,
                    'MSG' => $message)
            );
            $i++;
        }
    }
    $maxOffset = floor($entriesTotal / $entriesShown);
    if ($maxOffset * $entriesShown == $entriesTotal) {
        $maxOffset--;
    }

    $offsetForeward = $offset < $maxOffset ? $offset + 1 : 0;
    $offsetBackward = $offset > 0 ? $offset - 1 : $maxOffset;
    if ($revers == 0) {
        $entryTo = ($offset + 1) * $entriesShown;
        if ($entryTo > $entriesTotal) {
            $entryTo = $entriesTotal;
        }
        $pagination = sprintf(
            $lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z'],
            String::formatNumber($offset * $entriesShown + 1),
            String::formatNumber($entryTo),
            String::formatNumber($entriesTotal)
        );
    } else {
        $total = $maxOffset * $entriesShown;
        $entryFrom = $entriesTotal - ($offset * $entriesShown);
        if ($entryFrom > $entriesTotal) $entryFrom = $entriesTotal;
        $entryTo = $entriesTotal - (($offset + 1) * $entriesShown) + 1;
        if ($entryTo < 1) {
            $entryTo = 1;
        }
        $pagination = sprintf(
            $lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z'],
            String::formatNumber($entryFrom),
            String::formatNumber($entryTo),
            String::formatNumber($entriesTotal)
        );
    }

    $tplLog->assign_vars(
        array(
            'OFFSET_FOREWARD' => $offsetForeward,
            'OFFSET_BACKWARD' => $offsetBackward,
            'PAGINATION_ENTRIES' => $pagination)
    );
}
$tplLog->pparse('tplLog');
obend(true);
