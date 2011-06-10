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
$del = array();
if (isset($_POST['delete'])) {
    if (isset($_POST['file'])) {
        $delfiles = Array();
        for ($i = 0; $i < count($_POST['file']); $i++) {
            if (!strpos($_POST['file'][$i], '_part_') === false) {
                $pos = strpos($_POST['file'][$i], '_part_');
                $delfiles[] = substr($_POST['file'][$i], 0, $pos + 6);
            } else {
                $delfiles[] = $_POST['file'][$i];
            }
        }
        for ($i = 0; $i < count($delfiles); $i++) {
            $del = array_merge(
                $del,
                deleteMultipartFiles($config['paths']['backup'], $delfiles[$i])
            );
        }
    } else {
        $msg .= Html::getErrorMsg($lang['L_FM_NOFILE']);
    }
}
if (isset($_POST['deleteauto'])) {
    $deleteResult = doAutoDelete();
    if ($deleteResult > '') {
        $msg .= $deleteResult;
    }
}

if (isset($_POST['deleteall']) || isset($_POST['deleteallfilter'])) {
    if (isset($_POST['deleteall'])) {
        $del = deleteMultipartFiles($config['paths']['backup'], '', '.sql');
        $del = array_merge(
            $del, deleteMultipartFiles($config['paths']['backup'], '', '.gz')
        );
    } else {
        $del = deleteMultipartFiles($config['paths']['backup'], $dbactive);
    }
}

// print file-delete-messages
if (is_array($del) && sizeof($del) > 0) {
    foreach ($del as $file => $success) {
        if ($success) {
            $msg .= $lang['L_FM_DELETE1'] . ' \'' . $file . '\' ';
            $msg .= $lang['L_FM_DELETE2'];
            $msg = Html::getOkMsg($msg);
            $log->write(Log::PHP, "Deleted '$file'.");
        } else {
            $msg .= $lang['L_FM_DELETE1'] . ' \'' . $file . '\' ';
            $msg .= $lang['L_FM_DELETE3'];
            $msg = Html::getErrorMsg($msg);
            $log->write(Log::PHP, "Deleted '$file'.");
        }
    }
}
