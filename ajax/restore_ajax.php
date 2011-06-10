<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package          MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
error_reporting(E_ALL);
chdir('./../');
include ('./inc/classes/db/MsdDbFactory.php');
include ('./inc/classes/helper/String.php');
include ('./inc/classes/helper/Sql.php');
include ('./inc/classes/Log.php');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/mysql.php');
include ('./inc/functions/functions_global.php');
include ('./lib/template.php');
include ('./inc/functions/functions_restore.php');
include ('./lib/json.php');
obstart(true);
$config = $_SESSION['config'];
$databases = $_SESSION['databases'];
$restore = $_SESSION['restore'];
if (!isset($_SESSION['temp_log'])) {
    $_SESSION['temp_log'] = array();
}
// remember the start time to calculate speed later on
$restore['page_start_time'] = time();
if ($restore['page_refreshs'] > 0)
// clear temp log. Needed to find out if new log-messages were added
$_SESSION['temp_log'] = $_SESSION['log'];
if (!isset($config['language'])) {
    // some server limit the number of vars that can be saved in a session
    die('Incomplete session in restore_ajax.php');
}
$restore['restore_in_progress'] = 1;
$timeElapsed = 0;
$commandsFound = 0;
try
{
    $dbo->setConnectionCharset($restore['dump_encoding']);
    $dbo->selectDb($config['db_actual'], true);
}
catch (Exception $e)
{
    die($lang['L_DB_SELECT_ERROR'] . $config['db_actual']
        . $lang['L_DB_SELECT_ERROR2'] . '<br>' . $e->getMessage());
}

// open backup file
$file = $config['paths']['backup'] . $restore['filename'];
if ($restore['compressed'] == 1) {
    $restore['filehandle'] = gzopen($file, 'r');
} else {
    $restore['filehandle'] = fopen($file, 'r');
}
if (!$restore['filehandle']) {
    // fatal error: we couldn't open the backup file
    writeToErrorLog(
        '', '', $lang['L_FILE_OPEN_ERROR'] . ': ' . $config['paths']['backup']
        . $restore['filename'], 0
    );
    die($lang['L_FILE_OPEN_ERROR'] . ': ' . $restore['filename']);
}

$filesize = filesize($config['paths']['backup'] . $restore['filename']);
// move file pointer to the actual positon in the file
if ($restore['compressed']) {
    gzseek($restore['filehandle'], $restore['offset']);
} else {
    fseek($restore['filehandle'], $restore['offset']);
}
$log=new Log();

// Disable Keys of actual table (after page-refresh: again!)
// to speed up restoring
// but only if the table should be restored and if it already exists
$existingTables = $dbo->getTables($config['db_actual']);
$actualTable = $restore['actual_table'];
if (in_array($actualTable, $existingTables)) {
    if ($restore['tables_to_restore']) {
        if (in_array($actualTable, $restore['tables_to_restore'])) {
            Sql::disableKeys($dbo, $restore['actual_table']);
        }
    } elseif ($actualTable > '' && $actualTable != 'unbekannt') {
        Sql::disableKeys($dbo, $restore['actual_table']);
    }
}
WHILE ($commandsFound < $restore['speed'] &&
        $timeElapsed < $restore['max_zeit'] &&
        !$restore['fileEOF'] && !$restore['EOB']) {
    $sqlCommand = getQueryFromFile();
    $commandsFound++;
    if ($sqlCommand > '') {
        //$log->write(Log::PHP, $sqlCommand);
        try
        {
            $res = $dbo->query($sqlCommand, MsdDbFactory::SIMPLE);
            // get nr of affected rows
            $command = strtoupper(substr($sqlCommand, 0, 7));
            if ($command == 'INSERT ' || $command == 'REPLACE') {
                $rowsAffected = $dbo->getAffectedRows();
                $restore['records_inserted'] += $rowsAffected;
                if (!isset(
                    $restore['records_inserted_table'][$restore['actual_table']])
                ) {
                    $restore['records_inserted_table'][$restore['actual_table']] = 0;
                }
                $restore['records_inserted_table'][$restore['actual_table']] += $rowsAffected;
            }
        }
        catch (Exception $e)
        {
            // we've got a mysql error
            $sqlError = $e->getMessage();
            if ($sqlError != '') {
                if (strtolower(substr($sqlError, 0, 15)) == 'duplicate entry') {
                    writeToErrorLog(
                        $config['db_actual'], $sqlCommand, $sqlError, 1
                    );
                    $restore['notices']++;
                } else {
                    if ($config['stop_with_error'] == 0) {
                        // according to the config we continue restoring
                        // but log the error
                        writeToErrorLog(
                            $config['db_actual'],
                            $sqlCommand, $sqlError, 0
                        );
                        $restore['errors']++;
                    } else {
                        // we should die if errors occur -> print error message
                        writeToErrorLog(
                            $config['db_actual'],
                            $sqlCommand,
                            'Fatal error, restore failed: ' . $sqlError, 0
                        );
                        SQLError($sqlCommand, $sqlError);
                        $restore['restore_in_progress'] = 0;
                        die();
                        // TODO clean end of process - last message is not
                        // logged on restore screen and
                        // not sent back to client. Flag missing here that
                        // should be handled via JSON
                    }
                }
            }
        }
    }
    $timeElapsed = time() - $restore['page_start_time'];
}

if ($restore['compressed']) {
    $restore['offset'] = gztell($restore['filehandle']);
    gzclose($restore['filehandle']);
} else {
    $restore['offset'] = ftell($restore['filehandle']);
    fclose($restore['filehandle']);
}
$restore['page_refreshs']++;

// progress of actual file
if ($restore['compressed']) {
    // compressed backup - there is no way to get the exact file offset,
    // because gztell delivers uncompressed bytes
    // so we assume the average packing factor is 11 and will divide the file
    // offset by it
    $restore['progress_file_percent'] =
        $restore['offset'] / 11 * 100 / $filesize;
    if ($restore['progress_file_percent'] > 100)
    $restore['progress_file_percent'] = 100;
} else {
    // uncompressed backup -> get percentage from file offset
    $restore['progress_file_percent'] = 0;
    if ($filesize > 0) {
        $restore['progress_file_percent'] =
            ($restore['offset'] * 100) / $filesize;
    }

}

// Overall progress
if ($restore['records_total'] > 0) {
    // it's a backup of MySQLDumper (the number of total records is known) ->
    // calculate on count of records
    $restore['progress_overall_percent'] =
        $restore['records_inserted'] * 100 / $restore['records_total'];
} else {
    // backup from another script. We don't know how many records will follow
    $restore['progress_overall_percent'] = 0;
}
// tables to create
if ((int) $restore['tables_total'] > 0) {
    // MSD-Backup
    // tables to go
    $tablesToDo = $restore['tables_total'];
    // selected tables should be restored? Overwrite value
    if (is_array($restore['tables_to_restore']))
    $tablesToDo = count($restore['tables_to_restore']);
    $tablesToCreate = sprintf(
        $lang['L_RESTORE_TABLES_COMPLETED'], $restore['table_ready'], $tablesToDo
    );
    $recordsDone = sprintf(
        $lang['L_ACTUALLY_INSERTED_RECORDS_OF'],
        String::formatNumber($restore['records_inserted']),
        String::formatNumber($restore['records_total'])
    );
} else {
    // not a MSD-Backup
    $tablesToCreate = sprintf(
        $lang['L_RESTORE_TABLES_COMPLETED'],
        $restore['table_ready'],
        $lang['L_UNKNOWN']
    );
    $recordsDone = sprintf(
        $lang['L_ACTUALLY_INSERTED_RECORDS'],
        String::formatNumber($restore['records_inserted']),
        $lang['L_UNKNOWN']
    );
}

// calculate speed for next page call
if ($timeElapsed < $restore['max_zeit']) {
    // wenn wir mehr als die Haelfte der Zeit noch haetten nutzen koennen:
    // Anzahl direkt um fast das Doppelte erhoehen
    if ($timeElapsed < $restore['max_zeit'] / 2)
    $restore['speed'] = $restore['speed'] * 1.8;
    else $restore['speed'] = $restore['speed'] * $config['tuning_add'];
    if ($restore['speed'] > $config['maxspeed'])
    $restore['speed'] = $config['maxspeed'];
} else {
    $restore['speed'] = $restore['speed'] * $config['tuning_sub'];
    if ($restore['speed'] < $config['minspeed'])
    $restore['speed'] = $config['minspeed'];
}

if ($restore['fileEOF'] && $restore['part'] == 0)
$restore['EOB'] = true; //part is >0 if we have a Multipart backup
if ($restore['EOB']) {
    // Done
    $time = getTimeFormat(time() - $restore['restore_start_time']);
    $log->write(
        Log::PHP, sprintf(
            $lang['L_RESTORE_DB_COMPLETE_IN'],
            $config['db_actual'],
            $time
        )
    );
    $restore['restore_in_progress'] = 0;
} else {
    if ($restore['fileEOF']) {
        // let's get the next Multipart file
        $restore['fileEOF'] = false;
        $nextfile = getNextPart($restore['filename'], 0, true);
        // there is more to do -> process the next Multipart file
        if (!file_exists($config['paths']['backup'] . $nextfile)) {
            writeToErrorLog(
                $config['db_actual'], '',
                sprintf($lang['L_ERROR_MULTIPART_RESTORE'], $nextfile)
            );
            $restore['restore_in_progress'] = 0;
        } else {
            $restore['filename'] = $nextfile;
            $restore['offset'] = 0;
            $restore['part']++;
            $log->write(
                Log::PHP,
                sprintf(
                    $lang['L_CONTINUE_MULTIPART_RESTORE'],
                    $restore['filename']
                )
            );
        }
    }
}


// collect values to return to client
$r = array();
$json = new Services_JSON();
$r['restore_in_progress'] = $restore['restore_in_progress'];
if ($restore['page_refreshs'] == 1) {
    // Only send on first page call because values won't change
    $r['speed_min'] = String::formatNumber($config['minspeed']);
    $r['speed_max'] = String::formatNumber($config['maxspeed']);
    $r['dump_encoding'] = $restore['dump_encoding'];
}

// if restore is finished and file is gzipped, the file pointer
// might not be accurate
if ($restore['restore_in_progress'] == 0) {
    // correct percentage of file to now known exact value
    $restore['progress_file_percent'] = 100;
    $restore['speed'] = 0;
}

$r['filename'] = $restore['filename'];
$r['nr_of_errors'] = String::formatNumber($restore['errors']);
$r['nr_of_notices'] = String::formatNumber($restore['notices']);

$r['progress_file_percent'] = String::formatNumber(
    $restore['progress_file_percent'], 2
);
$r['progress_file_bar_width'] = round($restore['progress_file_percent'] * 3, 0);

if ($restore['progress_overall_percent'] > 0) {
    $r['progress_overall_percent'] = String::formatNumber(
        $restore['progress_overall_percent'], 2
    );
    $r['progress_overall_bar_width'] = round(
        $restore['progress_overall_percent'] * 3, 0
    );
} else {
    $r['progress_overall_percent'] = $lang['L_UNKNOWN'];
    $r['progress_overall_bar_width'] = 0;
}
if ($restore['part'] > 0) {
    $r['part'] = $restore['part'];
}
$r['tables_to_create'] = $tablesToCreate;
$r['records_done'] = $recordsDone;
$r['actual_table'] = sprintf(
    $lang['L_ANALYZING_TABLE'], $restore['actual_table']
);
$r['speed'] = String::formatNumber($restore['speed']);
$r['speedbar_width'] = round(
    $restore['speed'] * 100 / $config['maxspeed'] * 3, 0
);
$r['page_refreshs'] = String::formatNumber($restore['page_refreshs']);

$elapsed = time() - $restore['restore_start_time'];
$r['elapsed_time'] = getTimeFormat($elapsed);

// if we restore a MySQLDumper-Backup we know the nr of records and can
// calculate the estimated time from it
// if we restore a backup from another program we need to rely on the filesize
//which is not accurate
// when the file is gzipped, but we can't help it because there is no way to
// get the exact file pointer position in a gzipped file.
// So we give our best to guess the corect position (see line 117 above)
if ($restore['progress_overall_percent'] > 0) {
    $percentageDone = $restore['progress_overall_percent'];
} else {
    $percentageDone =  $restore['progress_file_percent'];
}
$estimatedTime = 0;
if ($percentageDone > 0) {
    $estimatedTime = (100 - $percentageDone) * ($elapsed / $percentageDone);
    $r['estimated_end'] = getTimeFormat($estimatedTime);
} else {
    $r['estimated_end'] = $lang['L_UNKNOWN'];
}

// check if new log-messages have been added
$messages = getArrayDiffAssocRecursive($_SESSION['log'], $_SESSION['temp_log']);
if (isset($messages['actions']) && is_array($messages['actions']))
$r['actions'] = implode('<br />', $messages['actions']);
if (isset($messages['errors']) && is_array($messages['errors']))
$r['errors'] = implode('<br />', $messages['errors']);
$_SESSION['log'] = $_SESSION['log'] + $_SESSION['temp_log'];

// save actual values to session
$_SESSION['restore'] = $restore;
echo $json->encode($r);
obend(true);
