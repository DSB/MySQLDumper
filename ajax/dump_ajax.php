<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1221 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
chdir('./../');
include ('./inc/classes/db/MsdDbFactory.php');
include ('./inc/classes/Log.php');
include ('./inc/classes/helper/String.php');
include ('./inc/classes/helper/Sql.php');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/mysql.php');
include ('./inc/functions/functions_global.php');
include ('./inc/functions/functions_dump.php');
include ('./lib/json.php');
obstart(true);
$dump = $_SESSION['dump'];
$dump['page_start_time'] = time();
$dump['progress_table_percent'] = 0;
$recordOffset = 0;
$recordsTotal = 0;
$prozent = 0;
$table = '';
$msg = '';
$log=new Log();
$dbo->setConnectionCharset($dump['dump_encoding']);
// each time a new database will be dumped ->
// look for Command before dump to be executed
if ($dump['table_offset'] == - 1)
    executeCommand('b');
$dump['data'] = ''; // will hold string data to be saved to the dump file
// needed to find out if new log-messages were added
$_SESSION['temp_log'] = $_SESSION['log'];
if (! isset($dump['table_records_total']))
    $dump['table_records_total'] = 0;
$tableIndex = $dump['table_offset'] == - 1 ? 0 : $dump['table_offset'];
if ($dump['backup_done'] == 0) {
    if ($dump['databases'][$dump['db_actual']]['table_count'] == 0) {
        //no tables found -> prevent creation of empty backupfile
        $msg = sprintf($lang['L_DUMP_NOTABLES'], $dump['db_actual']);
        if ($dump['databases'][$dump['db_actual']]['prefix'] != '') {
            $msg = sprintf($lang['L_DUMP_NOTABLES'], $dump['db_actual']);
            $msg .= ' (' . $lang['L_WITHPRAEFIX'] . ': \'' ;
            $msg .= $dump['databases'][$dump['db_actual']]['prefix']. '\')';
        }
        writeToErrorLog($dump['db_actual'], '', $msg);
        $dbsToBackup = array(
        $dump['db_actual']);
        $dump['backupdatei'] = '';
        $dump['filesize'] = 0;
        checkForNextDB();
    } else {
        if ($dump['table_offset'] == - 1) {
            // first call for this database -> create new backup file
            createNewFile();
            $dump['table_offset'] = 0; // begin with first table
            $dump['table_record_offset'] = 0;
            $dump['restzeilen'] = $config['minspeed'];
        }
        $dump['restzeilen'] = $dump['speed'];
        while ($dump['restzeilen'] > 0 && $dump['table_offset'] <
                $dump['databases'][$dump['db_actual']]['table_count']) {
            $tableNames = $dump['databases'][$dump['db_actual']]['tables'];
            $table = getValueFromIndex($tableNames, $dump['table_offset']);
            if ($dump['table_record_offset'] == 0) {
                $dbo->selectDb($dump['db_actual']);
                // a new table begins
                // optimize it?
                if ($config['optimize_tables_beforedump'] == 1) {
                    if (true === Sql::optimizeTable($dbo, $table)) {
                        $dump['tables_optimized']++;
                    }
                }
                $recordOffset = 0;
                $recordsTotal = 0;
                $dump['progress_table_percent'] = 0;
                $dump['speed'] = $config['minspeed'];
                // should we dump the table structure?
                if ($dump['databases'][$dump['db_actual']]['tables'][$table]['dump_structure'] > 0) {
                    // get create statement of table
                    try {
                        $records = $dump['databases'][$dump['db_actual']]['tables'][$table]['dump_records'];
                        $createStatement = getCreateString($dump['db_actual'], $table, $records);
                        $dump['data'] .= $createStatement;
                    } catch (Exception $e) {
                        // error reading table definition
                        writeToDumpFile(); // save data we have up to now
                        $logMsg = sprintf($lang['L_FATAL_ERROR_DUMP'], $table, $dump['db_actual']);
                        $readCreateError = $logMsg . ': ' . $e->getMessage();
                        writeToErrorLog($config['db_actual'], '', $readCreateError, 0);
                        $log->write(Log::ERROR, $readCreateError);
                        $dump['errors'] ++;
                        //next table
                        $dump['table_offset'] ++;
                        $dump['table_record_offset'] = 0;
                        // set records of table not to be dumped
                        $dump['databases'][$dump['db_actual']]['tables'][$table]['dump_records'] = 0;
                    }
                }
            }
            if ($dump['databases'][$dump['db_actual']]['tables'][$table]['dump_records'] ==1) {
                getContent($dump['db_actual'], $table);
            } else {
                //jump to next table if we don't need to dump the records of this table
                $dump['table_offset'] ++;
            }
            if (strlen($dump['data']) > $config['memory_limit']) {
                writeToDumpFile();
            }
        }
        // create list of databases for output
        $dbsToBackup = implode(', ', array_keys($dump['databases']));
        // highligth actual db
        $replace = '<span class="success">' . $dump['db_actual'] . '</span>';
        $dbsToBackup = str_replace($dump['db_actual'], $replace, $dbsToBackup);
        // we need to get the actual table again because it might have changed
        $table = getValueFromIndex($dump['databases'][$dump['db_actual']]['tables'], $dump['table_offset']);
        if ($table) {
            // get nr of records from dump-array
            $dump['table_records_total'] = $dump['databases'][$dump['db_actual']]['tables'][$table]['records'];
            if ($dump['table_records_total'] > 0) {
                $percent = (100 * $dump['table_record_offset']) / $dump['table_records_total'];
                $dump['progress_table_percent'] = round($percent, 2);
            } else {
                $dump['progress_table_percent'] = 0;
            }
            if ($dump['speed'] + $dump['table_record_offset'] >=
             $dump['table_records_total']) {
                $recordOffset = $dump['table_record_offset'] +
                 1;
                $recordsTotal = $dump['table_records_total'];
                if ($recordsTotal == 0) {
                    $recordOffset = 0;
                }
            } else {
                $recordsTotal = $dump['table_record_offset'] + $dump['speed'];
                $recordOffset = $dump['table_record_offset'] + 1;
            }
        } else {
            // looks like we've done the job
            $dump['table_offset'] ++;
            $dump['table_records_total'] = 0;
            $table = '';
        }
        writeToDumpFile();
        if ($dump['table_offset'] <= $dump['databases'][$dump['db_actual']]['table_count']) {
            $dauer = time() - $dump['page_start_time'];
            //Zeitanpassung
            if ($dauer < $dump['max_zeit']) {
                if ($dauer < $dump['max_zeit'] / 2) {
                    $dump['speed'] *= 1.8;
                } else {
                    $dump['speed'] *= $config['tuning_add'];
                }
                if ($dump['speed'] > $config['maxspeed']) {
                    $dump['speed'] = $config['maxspeed'];
                }
            } else {
                $dump['speed'] *= $config['tuning_sub'];
                if ($dump['speed'] < $config['minspeed']) {
                    $dump['speed'] = $config['minspeed'];
                }
            }
            $dump['speed'] = (int) $dump['speed'];
            $dump['page_refreshs'] ++;
        } else {
            //Backup for all databases is done
            $dump['data'] = "\nSET FOREIGN_KEY_CHECKS=1;";
            $dump['data'] .= "\n" .
             '-- EOB' . "\n\n";
            writeToDumpFile();
            executeCommand('a');
            chmod($config['paths']['backup'] . $dump['backupdatei'], 0777);
            $logMsg = sprintf($lang['L_DUMP_OF_DB_FINISHED'], $dump['db_actual']);
            $log->write(Log::PHP, $logMsg);
            checkForNextDB();
        }
    }
}
// everything is dumped -> check for e-mail and ftp-actions
if ($dump['backup_done'] == 1) {
    if (count($_SESSION['log']['files_created']) > 0) {
        if (! isset($_SESSION['log']['email'])) {
            // first call after backup is finished -> create todo-list
            $_SESSION['log']['email'] = array();
            $_SESSION['email']['filelist'] = array();
            $_SESSION['log']['ftp'] = array();
            foreach ($_SESSION['log']['files_created'] as $file) {
                if ($config['send_mail'] == 1) {
                    $_SESSION['log']['email'][] = $file;
                }
                foreach ($config['ftp'] as $index => $val) {
                    // build array with files to send. The key of $_SESSION['log']['ftp'] is the index of
                    // the ftp-connection details of the configuration profile to be used
                    if ($val['transfer'] == 1) {
                        if (! isset($_SESSION['log']['ftp'])) {
                            $_SESSION['log']['ftp'][$index] = array();
                        }
                        $_SESSION['log']['ftp'][$index][] = $file; // add file to transfer
                    }
                }
            }
            // don't start sending now, because we want to inform the client first and show the logentry
            // log-messages will be sent to client
            if ($config['send_mail'] == 1) {
                $log->write(Log::PHP, $lang['L_EMAIL_START']);
            }
            if (count($_SESSION['log']['ftp']) > 0) {
                $log->write(Log::PHP, $lang['L_FTP_START']);
            }
        } else {
            if (count($_SESSION['log']['email']) > 0) {
                // Ok we need to send an e-mail -> get index of first file
                $files = $_SESSION['log']['email'];
                $key = array_keys($files);
                doEmail($_SESSION['log']['email'][$key[0]]);
                unset($_SESSION['log']['email'][$key[0]]); // remove from array
            } else {
                $dump['backup_in_progress'] = 0; // all files sent
            }
            if ($dump['backup_in_progress'] == 0) {
                // check if ftp-transfers need to be done
                if (isset($_SESSION['log']['ftp']) && count($_SESSION['log']['ftp']) > 0) {
                    // a file needs to be transferred
                    $dump['backup_in_progress'] = 1; // indicate that there is still more to do
                    // get index of ftp-connection
                    $ftpConnectionIndexes = array_keys($_SESSION['log']['ftp']);
                    $ftpConnection = $ftpConnectionIndexes[0];
                    // now get next file to be transferred
                    $files = $_SESSION['log']['ftp'][$ftpConnection];
                    $fileKeys = array_keys($files);
                    if (isset($fileKeys[0])) {
                        $fileKey = $fileKeys[0];
                        sendViaFTP($ftpConnection, $_SESSION['log']['ftp'][$ftpConnection][$fileKey]);
                        // remove file from todo-list
                        unset($_SESSION['log']['ftp'][$ftpConnection][$fileKey]);
                    } else {
                        // all files transferred for this ftp-connection -> remove connection index
                        unset($_SESSION['log']['ftp'][$ftpConnection]);
                    }
                } else {
                    $dump['backup_in_progress'] = 0;
                }
            }
        }
    }
}
// get values to return
$r = array();
$json = new Services_JSON();
$r['backup_in_progress'] = $dump['backup_in_progress'];
// send vars that do not change while dumping only once
if ($dump['page_refreshs'] == 1) {
    $r['tables_total'] = $dump['tables_total'];
    $r['records_total'] = String::formatNumber($dump['records_total']);
    $r['speed_min'] = String::formatNumber($config['minspeed']);
    $r['speed_max'] = String::formatNumber($config['maxspeed']);
    $r['config_file'] = $config['config_file'];
    $r['dump_encoding'] = $dump['dump_encoding'];
    $r['comment'] = $dump['comment'] > '' ? $dump['comment'] : '-';
}
$r['table_records_total'] = String::formatNumber($dump['table_records_total']);
if (isset($dbsToBackup)) {
    $r['dbs_to_backup'] = $dbsToBackup;
}
$r['actual_database'] = $dump['db_actual'];
$r['actual_table'] = $table;
$_SESSION['actual_table'] = $table;
$r['actual_table_nr'] = String::formatNumber($dump['table_offset_total'] + 1);
$r['page_refreshs'] = String::formatNumber($dump['page_refreshs']);
$r['filename'] = $dump['backupdatei'];
$r['filesize'] = byteOutput($dump['filesize']);
$r['record_offset_start'] = String::formatNumber($recordOffset);
$r['record_offset_end'] = String::formatNumber($recordsTotal);
$r['progressbar_table_width'] = (int) $dump['progress_table_percent'] * 3;
$r['progress_table_percent'] = String::formatNumber($dump['progress_table_percent'], 2);
$elapsed = time() - $dump['dump_start_time'];
$r['elapsed_time'] = getTimeFormat($elapsed);
if ($dump['records_total'] > 0) {
    $progressOverallPercent = $dump['countdata'] * 100 / $dump['records_total'];
    if ($progressOverallPercent == 0) {
        $progressOverallPercent = 0.001;
    }
    $r['progress_overall_percent'] = String::formatNumber($progressOverallPercent, 2);
    $r['progressbar_overall_width'] = $r['progress_overall_percent'] * 3;
    $estimatedTime = ceil(($elapsed * 100 / $progressOverallPercent) - $elapsed);
    $r['estimated_end'] = getTimeFormat($estimatedTime);
}
$r['speed'] = String::formatNumber($dump['speed']);
$r['speedbar_width'] = (int) $dump['speed'] * 100 / $config['maxspeed'] * 3;
$r['nr_of_errors'] = $dump['errors'] == 0 ? '-' : $dump['errors'];
$r['records_saved_total'] = String::formatNumber($dump['countdata']);
$r['tables_optimized'] ='';
if ($dump['tables_optimized'] > 0) {
    $r['tables_optimized'] = sprintf($lang['L_NR_TABLES_OPTIMIZED'], String::formatNumber($dump['tables_optimized']));
}
if ($msg > '') {
    $r['log'] = $msg;
}
if ($config['multi_part'] == 1) {
    $r['multipart_part'] = $dump['part'] - $dump['part_offset'] - 1;
}
$r['prefix'] = '';
if (isset($dump['databases'][$dump['db_actual']]['prefix'])) {
    $r['prefix'] = $dump['databases'][$dump['db_actual']]['prefix'];
}
// check if new log-messages werde added
$messages = getArrayDiffAssocRecursive($_SESSION['log'], $_SESSION['temp_log']);
if (isset($messages['actions']) && is_array($messages['actions'])) {
    $r['actions'] = implode('<br />', $messages['actions']);
}
if (isset($messages['errors']) && is_array($messages['errors'])) {
    $r['errors'] = implode('<br />', $messages['errors']);
}
$_SESSION['log'] = $_SESSION['log'] + $_SESSION['temp_log'];
$dump['last_db_actual'] = $dump['db_actual'];
//backup_done means that all tables are saved. The overall progress
//(emails, ftp) can still continue
if ($dump['backup_done'] == 1) {
    // some values need to be decreased
    $r['progressbar_table_width'] = 0;
    $r['progress_table_percent'] = '';
    $r['actual_database'] = '';
    $r['actual_table'] = '';
    $r['record_offset_start'] = '-';
    $r['record_offset_end'] = '-';
    $r['table_records_total'] = '-';
    $r['actual_table_nr'] = String::formatNumber($dump['table_offset_total']);
    $r['progress_overall_percent'] = String::formatNumber(100, 2);
    $r['progressbar_overall_width'] = 300;
    $r['speed'] = 0;
    $r['speedbar_width'] = 0;
}
// save actual values to session
$_SESSION['dump'] = $dump;
echo $json->encode($r);
obend(true);