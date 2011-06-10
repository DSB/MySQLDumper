<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1209 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

if (!defined('MSD_VERSION')) die('No direct access.');

/**
 * Creates a new backup file including the header information
 *
 * @return void
 */
function createNewFile()
{
    global $dump, $databases, $config, $lang, $log;

    // Dateiname aus Datum und Uhrzeit bilden
    if ($dump['part'] - $dump['part_offset'] == 1) {
        $dump['filename_stamp'] = date("Y_m_d_H_i", time());
    }
    if ($config['multi_part'] == 1) {
        $dateiname = $dump['db_actual'] . '_' . $dump['filename_stamp']
            . '_part_' . ($dump['part'] - $dump['part_offset']);
    } else {
        $dateiname = $dump['db_actual'] . '_' . date("Y_m_d_H_i", time());
    }
    $endung = ($config['compression']) ? '.sql.gz' : '.sql';
    $dump['backupdatei'] = $dateiname . $endung;
    $_SESSION['log']['files_created'][] = $dump['backupdatei'];

    if (file_exists($config['paths']['backup'] . $dump['backupdatei'])) {
        unlink($config['paths']['backup'] . $dump['backupdatei']);
    }
    $curTime = date("Y-m-d H:i");
    $statuszeile = getStatusLine() . "\n-- Dump by MySQLDumper " . MSD_VERSION
        . ' (' . $config['homepage'] . ')' . "\n";
    $statuszeile .= '/*!40101 SET NAMES \'' . $dump['dump_encoding']
        . '\' */;' . "\n";
    $statuszeile .= 'SET FOREIGN_KEY_CHECKS=0;' . "\n";

    if ($dump['part'] - $dump['part_offset'] == 1) {
        $log->write(
            Log::PHP,
            sprintf(
                $lang['L_SAVING_DATA_TO_FILE'],
                $dump['db_actual'],
                $dump['backupdatei']
            )
        );
        if ($dump['part'] == 1) {
            $dump['table_offset'] = 0;
            $dump['countdata'] = 0;
        }
        // Seitenerstaufruf -> Backupdatei anlegen
        $dump['data'] = $statuszeile . '-- Dump created: ' . $curTime;
    } else {
        if ($config['multi_part'] != 0) {
            $log->write(
                Log::PHP,
                sprintf(
                    $lang['L_SAVING_DATA_TO_MULTIPART_FILE'],
                    $dump['backupdatei']
                )
            );
            $dump['data'] = $statuszeile . '-- ' . ' This is part '
                . ($dump['part'] - $dump['part_offset']) . ' of the backup.'
                . "\n\n" . $dump['data'];
        }
    }
    writeToDumpFile();
    $dump['part']++;
}

/**
 * Creates the first statusline with information for backup files
 *
 * @return string
 */
function getStatusLine()
{
    // strcuture of status line:
    // -- Status:nrOfTables:nrOfRecords:Multipart:database:script:
    // scriptversion:comment:MySQL-Version:Backupflags(unused):SQLBefore:
    //SQLAfter:Charset:CharsetEXTINFO

    global $databases, $config, $dump;
    if (!defined('MSD_MYSQL_VERSION')) {
        GetMySQLVersion();
    }
    $tline = "-- \n-- TABLE-INFO\r\n";

    foreach ($dump['databases'][$dump['db_actual']]['tables']
        as $tableName => $val) {
        $tline .= "-- TABLE|" . $tableName . '|' . $val['records']
            . '|' . $val['data_length'] . '|' . $val['update_time'] . '|'
            . $val['engine'] . "\n";
    }
    $flags = 1;
    $mp = 'MP_0';
    if ($config['multi_part'] == 1) {
        $mp = "MP_" . ($dump['part'] - $dump['part_offset']);
    }
    $statusline = "-- Status:"
        . $dump['databases'][$dump['db_actual']]['table_count']
        . ':' . $dump['databases'][$dump['db_actual']]['records_total']
        . ":$mp:" . $dump['db_actual'] . ":PHP:" . MSD_VERSION . ":"
        . $dump['comment'] . ":";
    $statusline .= MSD_MYSQL_VERSION . ":$flags:::" . $dump['dump_encoding']
        . ":EXTINFO\n" . $tline . "-- " . "EOF TABLE-INFO\n-- ";
    return $statusline;
}

/**
 * Build the DROP and CREATE TABLE string for dump file.
 *
 * Parameter $withdata decides if we should add the
 * "ALTER TABLE DISABLE KEYS"-query.
 *
 * @param string  $db       The database
 * @param string  $table    The table
 * @param integer $withdata Add DISABLE KEYS
 * @return string $def Created Query-string or false on error
 */
function getCreateString($db, $table, $withdata = 1)
{
    global $dbo, $config, $dump, $lang, $log;

    $def = "\n\n--\n-- Table structure for table `$table`\n--\n";
    if ($dump['databases'][$dump['db_actual']]['tables'][$table]['engine']
        == 'VIEW') {
        $def .= "DROP VIEW IF EXISTS `$table`;\n";
        $withdata = 0;
    } else {
        $def .= "DROP TABLE IF EXISTS `$table`;\n";
    }
    $createStatement = $dbo->getTableCreate($table, $db);
    $def .= $createStatement . ';' . "\n\n";
    if ($withdata == 1) {
        $def .= "--\n-- Dumping data for table `$table`\n--\n";
        $def .= "/*!40000 ALTER TABLE `$table` DISABLE KEYS */;\n";
    }
    $log->write(Log::PHP, sprintf($lang['L_CREATE_TABLE_SAVED'], $table));
    return $def;
}

/**
 * Read records from table, build query-strings and write them to dump file
 *
 * @param string $db    The database to read from
 * @param string $table The table to read from
 * @return void
 */
function getContent($db, $table)
{
    global $dbo, $config, $dump, $lang, $log;

    $content = '';
    $fields = $dbo->getTableColumns($table, $db);
    // TODO decide if the type of field needs to be escaped and placed between quotes
    // also handle NULL-values very strict for MySQL-servers running with sql-mod=STRICT
    $fieldNames = array_keys($fields);
    $fieldList = '`' . implode('`,`', $fieldNames) . '`';
    // indicator if the actual table is fully dumped in this call
    $tableDone = 0;
    $sql = 'SELECT * FROM `' . $db . '`.`' . $table . '` LIMIT '
        . $dump['table_record_offset'] . ',' . ($dump['restzeilen'] + 1);
    $result = $dbo->query($sql, MsdDbFactory::ARRAY_NUMERIC);
    $numRows = @count($result);
    if ($numRows > 0) {
        // we've got records - get fields
        $numfields = count($result[0]);
        if ($numRows > $dump['restzeilen']) {
            // there are more records to get - table is not fully dumped
            $dump['table_record_offset'] += $dump['restzeilen']; //set table record offset for next call
            $numRows--; // correct counter - we only used the last record to find out if there is more to fetch
            unset($result[$numRows]);
        } else {
            // table is done -> increase table offset
            $recordsSaved = $dump['table_record_offset'] + $numRows;
            $log->write(
                Log::PHP,
                sprintf(
                    $lang['L_BACKUP_TABLE_DONE'],
                    $table,
                    String::formatNumber($recordsSaved)
                )
            );
            $dump['table_offset']++;
            $dump['table_offset_total']++;
            $dump['table_record_offset'] = 0;
            $tableDone = 1;
        }
        foreach ($result as $row) {
            //if($config['backup_using_updates']==1){
            $insert = 'INSERT INTO `' . $table . '` (' . $fieldList
                . ') VALUES (';
            //TODO implement REPLACE INTO for expert mode
            //	}
            //else{
            //$insert='REPLACE INTO `'.$table.'` '.$complete.' VALUES (';
            //	}

            foreach ($row as $field => $val) {
                if ($val != '') $insert .= '\'' . $dbo->escape($val) . '\',';
                else $insert .= '\'\',';
            }
            $insert = substr($insert, 0, -1) . ');' . "\n";
            $dump['data'] .= $insert;
            $dump['restzeilen']--;
            $dump['countdata']++;
            if (strlen($dump['data']) > $config['memory_limit']
                || ($config['multi_part'] == 1
                && strlen($dump['data']) + MULTIPART_FILESIZE_BUFFER
                    > $config['multipart_groesse'])) {
                writeToDumpFile();
            }
        }
        if ($tableDone == 1) {
            // check if records have been saved and add "enable keys"
            $tables = $dump['databases'][$dump['db_actual']]['tables'];
            if ($tables[$table]['dump_records'] == 1) {
                $dump['data'] .= "/*!40000 ALTER TABLE `$table`"
                    ." ENABLE KEYS */;";
            }
        }
    } else {
        // table corrupt -> skip it
        $dump['table_offset']++;
        $dump['table_offset_total']++;
        $dump['table_record_offset'] = 0;
        $dump['restzeilen'] = $dump['restzeilen'] - $numRows;
        $dump['data'] .= "/*!40000 ALTER TABLE `$table` ENABLE KEYS */;\n";
        if (strlen($dump['data']) > $config['memory_limit']
            || ($config['multi_part'] == 1 && strlen($dump['data'])
            + MULTIPART_FILESIZE_BUFFER > $config['multipart_groesse'])) {
            writeToDumpFile();
        }
    }
}

/**
 * Saves the created data of global var $dump['data'] to the dump file.
 *
 * If Multipart is used and the maximum filesize is reached a new file is
 * created. Sets global var $dump['filesize'] to new vaule for printing
 * on sccreen.
 *
 * @return void
 */
function writeToDumpFile()
{
    global $config, $dump;
    $file = $config['paths']['backup'] . $dump['backupdatei'];

    if ($config['compression'] == 1) {
        if ($dump['data'] != '') {
            $fp = gzopen($file, 'ab');
            gzwrite($fp, $dump['data']);
            gzclose($fp);
        }
    } else {
        if ($dump['data'] != '') {
            $fp = fopen($file, 'ab');
            fwrite($fp, $dump['data']);
            fclose($fp);
        }
    }
    $dump['data'] = '';
    clearstatcache();
    $dump['filesize'] = intval(@filesize($file));
    // if Multipart is used and maximum filesize is reached -> create new file
    if ($config['multi_part'] == 1) {
        if ($dump['filesize'] + MULTIPART_FILESIZE_BUFFER
            > $config['multipart_groesse']) {
            @chmod($file, 0777);
            createNewFile();
        }
    }
}

/**
 * Checks if there is a next db to be dumped
 *
 * Sets the global flag $dump['backup_done']
 *
 * @return void
 */
function checkForNextDB()
{
    global $dump;
    // a check, if another db should be saved is at the end of the script
    // backup of actual db is done -> lets check if there is more to do
    $nextDb = getNextKey($dump['databases'], $dump['db_actual']);
    if ($nextDb !== false) {
        $dump['backup_done'] = 0;
        //-1 instead of 0 is needed for the execution of command before backup
        $dump['table_offset'] = -1;
        $dump['db_actual'] = $nextDb;
        $dump['part_offset'] = $dump['part'] - 1;
    } else {
        $dump['backup_done'] = 1;
        $dump['table_offset_total']--;
    }
}

/**
 * Execute queries before and after the backup process
 *
 * Queries are saved in the configuration profile
 *
 * @param string $when Before (b) or after backup process
 *
 * @return void
 */
function executeCommand($when)
{
    // TODO implement execution of command before/after backup
    return;
}

/**
 * Send e-mail and attach file
 *
 * @param string $file
 * @return boolean
 */
function doEmail($file)
{
    global $config, $dump, $lang, $log;
    include ('lib/phpmailer/php5/class.phpmailer.php');
    include ('inc/classes/helper/Html.php');
    // get some status info from actual file
    $rootpath = $config['paths']['root'] . $config['paths']['backup'];
    $fileInfo = ReadStatusline($file);
    $fileInfo['size'] = @filesize($rootpath . $file);
    $database = $fileInfo['dbname'];
    $tablesSaved = $fileInfo['tables'];
    $recordsSaved = $fileInfo['tables'];

    if (sizeof($_SESSION['email']['filelist']) == 0) {
        // first call after backup -> create file list of all files for each database
        $_SESSION['email']['filelist'] = array();
        foreach ($_SESSION['log']['email'] as $filename) {
            $statusInfo = ReadStatusline($filename);
            if (!isset($_SESSION['email']['filelist'][$statusInfo['dbname']])) {
                $_SESSION['email']['filelist'][$statusInfo['dbname']] = array();
            }
            $_SESSION['email']['filelist'][$statusInfo['dbname']][] = $filename;
        }
    }
    // create file list for specific database
    $filelist = '';
    foreach ($_SESSION['email']['filelist'][$database] as $filename) {
        $phpSelf = $_SERVER['PHP_SELF'];
        $linkToFile = '<a href="' . getServerProtocol()
            . $_SERVER['HTTP_HOST']
            . substr($phpSelf, 0, strrpos($phpSelf, '/'))
            . '/' . $config['paths']['backup'] . $filename . '">'
            . $filename . '</a>';
        $filelist .= $linkToFile;
        if ($file == $filename && $config['email']['attach_backup']) {
            $filelist .= ' (' . $lang['L_ATTACHED_AS_FILE'] . ')';
        }
        $filelist .= '<br />' . "\n";
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'utf-8';
    $mail->PlugInDir = 'lib/phpmailer/php5/';
    $mail->From = $config['email']['sender_address'];
    $mail->FromName = $config['email']['sender_name'];
    $mail->AddAddress($config['email']['recipient_address'], $config['email']['recipient_name']);

    // add cc-recipients
    foreach ($config['email']['recipient_cc'] as $recipient) {
        if ($recipient['address'] > '') {
            $mail->AddCC($recipient['address'], $recipient['name']);
        }
    }
    //build subject
    $subject = $lang['L_DUMP_FILENAME'] . ': ' . $file;
    if ($fileInfo['comment'] > '') {
        $subject = $fileInfo['comment'] . ', ' . $subject;
    }
    $mail->Subject = $subject;

    $mail->Timeout = 60;
    // set used mail-method
    $mail->IsMail(); //defaults to php-mail-function
    if ($config['use_mailer'] == 1) {
        $mail->IsSendmail();
        $mail->Sendmail = $config['sendmail_call'];
    } elseif ($config['use_mailer'] == 2) {
        $mail->IsSMTP();
        //debug
        //$mail->SMTPDebug = PHP_INT_MAX;
        $mail->Host = $config['smtp_server'];
        $mail->Port = $config['smtp_port'];
        // auth?
        if ($config['smtp_useauth']) {
            $mail->SMTPAuth = true;
            $mail->Username = $config['smtp_user'];
            $mail->Password = $config['smtp_pass'];
        }
        //use ssl?
        if ($config['smtp_usessl']) {
            $mail->SMTPSecure = 'tls';
        }
    }

    //build mail body
    $body = '';

    //add attachement?
    if ($config['email']['attach_backup']) {
        //check if file is bigger than allowed max size
        if ($config['email_maxsize'] > 0
            && $fileInfo['size'] > $config['email_maxsize']) {
            // attachement too big -> don't attach and paste message to body
            $body .= sprintf(
                $lang['L_EMAILBODY_TOOBIG'],
                byteOutput($config['email_maxsize']),
                $database,
                $file . ' (' . byte_output(
                    filesize($config['paths']['backup'] . $file)
                )
                . ')<br />'
            );
        } else {
            // add file as attachement
            $mail->AddAttachment($rootpath . $file);
            $body .= sprintf($lang['L_EMAILBODY_ATTACH'], $database, $filelist);
        }
    } else {
        // don't attach backup file according to configuration
        $body .= sprintf(
            $lang['L_EMAILBODY_TOOBIG'],
            byteOutput($config['email_maxsize']),
            $database,
            "$file (" . byteOutput(
                filesize($config['paths']['backup'] . $file)
            )
            . ")<br />"
        );
    }

    //set body
    $mail->MsgHTML($body);
    //build alternative-body without tags for mail-clients blocking HTML
    $altBody = strip_tags(Html::br2nl($body));
    $mail->AltBody = $altBody;

    $mail->Timeout = 30;
    $ret = $mail->Send();
    if (!$ret) {
        writeToErrorLog(
            '', '', $lang['L_MAILERROR'] . ' -> ' . $mail->ErrorInfo, 0
        );
        $log->write(Log::PHP, $lang['L_MAILERROR']);
    } else {
        $msg = $lang['L_EMAIL_WAS_SEND'] . "`"
            . $config['email']['recipient_address'];
        $log->write(Log::PHP, $msg);
    }
    return $ret;
}

/**
 * Transfers a file via FTP and logs each action
 *
 * @param integer $ftpConnectionIndex Index of FTP-Connection in configuration
 * @param string  $sourceFile        File to transfer
 * @return void
 */
function sendViaFTP($ftpConnectionIndex, $sourceFile)
{
    global $config, $lang, $log;

    $upload = false;
    $i = $ftpConnectionIndex; // I am lazy ;)
    // connect to ftp server
    if ($config['ftp'][$i]['ssl'] == 0) {
        $connId = @ftp_connect(
            $config['ftp'][$i]['server'],
            $config['ftp'][$i]['port'],
            $config['ftp'][$i]['timeout']
        );
    } else {
        $connId = @ftp_ssl_connect(
            $config['ftp'][$i]['server'],
            $config['ftp'][$i]['port'],
            $config['ftp'][$i]['timeout']
        );
    }

    if (is_resource($connId)) {
        $log->write(
            Log::PHP,
            $lang['L_FTP'] . ': ' .
            sprintf(
                $lang['L_FTP_CONNECTION_SUCCESS'],
                $config['ftp'][$i]['server'],
                $config['ftp'][$i]['port']
            )
        );
    } else {
        $msg = sprintf(
            $lang['L_FTP_CONNECTION_ERROR'],
            $config['ftp'][$i]['server'],
            $config['ftp'][$i]['port']
        );
        writeToErrorLog('', '', $lang['L_FTP'] . ': ' . $msg, 0);
    }

    // login using user and password
    $loginResult = @ftp_login(
        $connId,
        $config['ftp'][$i]['user'],
        $config['ftp'][$i]['pass']
    );
    if (!$loginResult) {
        writeToErrorLog(
            '',
            '',
            $lang['L_FTP'] . ': ' . sprintf(
                $lang['L_FTP_LOGIN_ERROR'],
                $config['ftp'][$i]['user']
            ),
            0
        );
    } else {
        $log->write(
            Log::PHP,
            $lang['L_FTP'] . ': ' . sprintf(
                $lang['L_FTP_LOGIN_SUCCESS'],
                $config['ftp'][$i]['user']
            )
        );
    }
    if ($config['ftp'][$i]['mode'] == 1) {
        if (@ftp_pasv($connId, true)) {
            $log->write(
                Log::PHP,
                $lang['L_FTP'] . ': ' . $lang['L_FTP_PASV_SUCCESS']
            );
        } else {
            writeToErrorLog(
                '', '',
                $lang['L_FTP'] . ': ' . $lang['L_FTP_PASV_ERROR'], 0
            );
        }
    }

    // Upload der Datei
    $dest = $config['ftp'][$i]['dir'] . $sourceFile;
    $source = $config['paths']['backup'] . $sourceFile;
    $upload = @ftp_put($connId, $dest, $source, FTP_BINARY);
    // Upload-Status überprüfen
    if (!$upload) {
        writeToErrorLog(
            '', '', sprintf($lang['L_FTP_FILE_TRANSFER_ERROR'], $sourceFile), 0
        );
    } else {
        $log->write(
            Log::PHP,
            sprintf($lang['L_FTP_FILE_TRANSFER_SUCCESS'], $sourceFile)
        );
    }

    // Schließen des FTP-Streams
    @ftp_quit($connId);
    $log->write(Log::PHP, $lang['L_FTP_CONNECTION_CLOSED']);
}

/**
 * Gets all information about a dump process and stores it in global $dump-Array
 *
 * @return void
 */
function prepareDumpProcess()
{
    global $databases, $dump, $config, $tableInfos;
    $dump['databases'] = array();
    $dump['records_total'] = 0;
    $dump['tables_total'] = 0;
    $dump['datasize_total'] = 0;
    // make copy of database-array to make changes for value "dump" just here
    $dbs = $databases;
    // first check if any db is marked to be dumped
    $dbToDumpExists = false;
    foreach ($dbs as $val) {
        if (isset($val['dump']) && $val['dump'] == 1) {
            // Db should be saved
            $dbToDumpExists = true;
            break;
        }
    }
    // no db selected for dump -> set actual db to be dumped
    if (!$dbToDumpExists) {
        $dbs[$config['db_actual']]['dump'] = 1;
    }

    // find out which databases and tables should be saved
    // dump=0 -> don't dump records
    // dump=1 -> dump records using "INSERT INTO"
    foreach ($dbs as $dbName => $val) {
        if (isset($val['dump']) && $val['dump'] > 0) {
            // db should be dumped
            // now lets check which tables should be saved
            // for now we save all tables -> later check prefixes etc...
            $tableInfos = getTableInfo($dbName);
            if (isset($tableInfos[$dbName])) {
                if (!isset($dump['databases'][$dbName])) {
                    $dump['databases'][$dbName] = array();
                }
                // calculate sums
                $dump['databases'][$dbName] = $tableInfos[$dbName];
                $dump['databases'][$dbName]['prefix'] = '';
                if (isset($databases[$dbName]['prefix'])) {
                    $dump['databases'][$dbName]['prefix'] =
                        $databases[$dbName]['prefix'];
                }
                $dump['records_total'] +=
                    $dump['databases'][$dbName]['records_total'];
                $dump['tables_total'] +=
                    $dump['databases'][$dbName]['table_count'];
                $dump['datasize_total'] +=
                    $dump['databases'][$dbName]['datasize_total'];

                // check if tables are selected ->
                // then remove all others from array and correct sums
                if ($dbName == $_SESSION['config']['db_actual']
                    && isset($dump['selected_tables'])
                    && is_array($dump['selected_tables'])
                    && count($dump['selected_tables']) > 0) {
                    foreach ($dump['databases'][$dbName]['tables']
                        as $tablename => $val) {
                        if (!in_array($tablename, $dump['selected_tables'])) {
                            $dump['databases'][$dbName]['tables'][$tablename]['dump_structure'] = 0;
                            $dump['databases'][$dbName]['tables'][$tablename]['dump_records'] = 0;

                            // remove table from todo-list
                            unset($dump['databases'][$dbName]['tables'][$tablename]);
                            // substract values of table from sums
                            $dump['tables_total']--;
                            $dump['databases'][$dbName]['table_count']--;
                            $dump['databases'][$dbName]['records_total'] -= $val['records'];
                            $dump['databases'][$dbName]['datasize_total'] -= $val['data_length'];
                            $dump['databases'][$dbName]['size_total'] -= $val['data_length'] + $val['index_length'];
                            $dump['datasize_total'] -= $val['data_length'];
                            $dump['records_total'] -= $val['records'];
                        }
                    }
                }
            }
        }
    }
    // set db to be dumped first -> start index is needed
    $dbNames=array_keys($dump['databases']);
    $dump['db_actual'] = $dbNames[0];
}

