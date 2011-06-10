<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         $Rev$
 * @author          $Author$
 * @lastmodified    $Date$
 */
if (!defined('MSD_VERSION')) die('No direct access.');

$orderDirection = 'ASC';
if (isset($_SESSION['sql']['order_direction'])) {
    $orderDirection = $_SESSION['sql']['order_direction'];
}
if (isset($_GET['order_direction'])) {
    $orderDirection = $_GET['order_direction'];
}
if (!isset($_GET['order_by_field'])) {
    $orderByField = '';
} else {
    $orderByField = base64_decode($_GET['order_by_field']);
}
$offset = 0;
if (isset($_SESSION['sql']['offset'])) {
    $offset = (int) $_SESSION['sql']['offset'];
}

$tplSqlbrowserSqlboxShowResults = new MSDTemplate();
$tplSqlbrowserSqlboxShowResults->set_filenames(
    array(
        'tplSqlbrowserSqlboxShowResults' =>
        'tpl/sqlbrowser/sqlbox/showResults.tpl'
    )
);
if (!isset($_SESSION['sql']['last_statement'])) {
    $_SESSION['sql']['last_statement'] = '';
}
// execute last statement if we came from another site
if (isset($sql['sql_statements']) && $sql['sql_statements'] > '') {
    $_POST['execsql'] = 1;
    $_POST['sqltextarea'] = $sql['sql_statements'];
}
//SQL-Statement given? Analyse and execute
if ($_POST['sqltextarea'] > '' && (isset($_POST['execsql'])
    || $action == 'general_sqlbox_show_results')) {
    //TODO Create class that handles queries and result sets using the same
    // parser like when restoring a backup file.
    // For the moment we do it quick and dirty by writing a temp file and hand
    // it over to the parser, pretending that this is a file to be restored.

    // do we have only 1 query or more?
    if (isset($_POST['sqltextarea']) &&
        $_POST['sqltextarea'] != $_SESSION['sql']['last_statement']) {
        $_SESSION['sql']['last_statement'] = $_POST['sqltextarea'];
        $offset = 0;
        $data = $_POST['sqltextarea'];
    }

    if ($action == 'general_sqlbox_show_results') {
        $data = $_SESSION['sql']['statements'];
    }
    if (isset($_POST['sqltextarea'])) {
        $data = $_POST['sqltextarea'];
    }
    // save as file and prepare vars to let the restore parser handle it
    $fileName = 'sqlbox_' . session_id() . '.sql';
    if (file_exists($config['paths']['backup'] . $fileName)) {
        unlink($config['paths']['backup'] . $fileName);
    }
    $f = fopen($config['paths']['backup'] . $fileName, 'w');
    fwrite($f, $data);
    fclose($f);
    $restore['filename'] = $fileName;
    $restore['filehandle'] = fopen($config['paths']['backup'] . $fileName, 'r');
    $restore['compressed'] = 0;
    $restore['dump_encoding'] = 'utf8';
    $restore['max_zeit'] = intval(
        $config['max_execution_time'] * $config['time_buffer']
    );
    if ($restore['max_zeit'] == 0) $restore['max_zeit'] = 20;
    $restore['restore_start_time'] = time();
    $restore['speed'] = $config['minspeed'];
    $restore['fileEOF'] = false;
    $restore['actual_table'] = '';
    $restore['offset'] = 0;
    $restore['page_refreshs'] = 0;
    $restore['table_ready'] = 0;
    $restore['errors'] = 0;
    $restore['notices'] = 0;
    $restore['actual_fieldcount'] = 0;
    $restore['records_inserted'] = 0;
    $restore['records_inserted_table'] = array();
    $restore['extended_inserts'] = 0;
    $restore['extended_insert_flag'] = -1;
    $restore['last_parser_status'] = 0;
    $restore['EOB'] = false;
    $restore['fileEOF'] = false;
    $restore['tables_to_restore'] = false; // restore complete file
    do {
        $query = getQueryFromFile(false);
        if (!is_array($query)) {
            $queries[] = $query;
        } else {
            // error in Query
            $error[] = $query[1];
            break;
        }
    } while (!$restore['fileEOF']);
    // close and remove temp file after the job is done
    fclose($restore['filehandle']);
    @unlink($config['paths']['backup'].$fileName);
    if (isset($_POST['tablecombo']) && $_POST['tablecombo'] > '') {
        $sql['sql_statements'] = $_POST['tablecombo'];
        $tablename = extractTablenameFromSQL($sql['sql_statements']);
    }
    $sql['sql_statements'] = implode("\n", $queries);
}

//Pager clicked?
if (isset($_POST['page_back'])) {
    $offset -= $config['resultsPerPage'];
    if ($offset < 0) $offset = 0;
}
if (isset($_POST['page_full_back'])) {
    $offset = 0;
}
if (isset($_POST['page_forward'])) {
    $offset += $config['resultsPerPage'];
}

if (isset($_POST['page_full_forward'])) {
    $offset = $_SESSION['num_records_total'] - $config['resultsPerPage'];
}

if (sizeof($queries) == 1) {
    $tablename = extractTablenameFromSQL($queries[0]);
    $tplSqlbrowserSqlbox->assign_block_vars(
        'SHOW_TABLENAME', array(
            'TABLE' => $tablename,
            'TABLE_ENCODED' => base64_encode($tablename))
    );

    // remove all values and names in query
    $tempQuery = preg_replace('/"(.*?)"/si', '', $queries[0]);
    $tempQuery = preg_replace('/\'(.*?)\'/si', '', $queries[0]);
    $tempQuery = preg_replace('/`(.*?)`/si', '', $queries[0]);

    // now we can decide if we can add a limit clause or if it already has one
    if (strripos($tempQuery, ' LIMIT ') === false) {
        $queries[0] .= ' LIMIT ' . $offset . ', ' . $config['resultsPerPage'];
    }

    // handle order direction if query doesn't have one
    if ($orderByField > '' && strripos($tempQuery, ' ORDER BY') === false) {
        $limitPosition = strripos($queries[0], ' LIMIT ');
        $orderClause = ' ORDER BY `' . $orderByField . '` ' . $orderDirection;
        if (false === $limitPosition) {
            // no limit found -> concat
            $queries[0] .= ' ORDER BY `' . $orderByField . '` ' . $orderDirection;
        } else {
            //inject order-clause in front of limit-clause
            $tempOne = substr($queries[0], 0, $limitPosition);
            $tempTwo = substr($queries[0], $limitPosition);
            $queries[0] = $tempOne . $orderClause . $tempTwo;
        }
    }

    // Injcet SQL_CALC_NUM_ROWS if we have a select query
    if (strtoupper(substr($queries[0], 0, 7)) == 'SELECT ') {
        $queries[0] = 'SELECT SQL_CALC_FOUND_ROWS ' . substr($queries[0], 7);
    }

    try
    {
        $res = $dbo->query($queries[0], MsdDbFactory::ARRAY_ASSOC);
        $error = '';
    }
    catch (Exception $e)
    {
        //v($res);
        $error = '(' . $e->getCode() . ') ' . $e->getMessage();
        $_SESSION['sql']['offset'] = $offset;
        $_SESSION['num_records_total'] = 0;
        //echo "MySQL-Fehler: " . $queries[0] . "<br>" . $error;
        $tplSqlbrowserSqlboxShowResults->assign_block_vars(
            'MESSAGE', array(
                'TEXT' => Html::getJsQuote($error, true),
                'NOTIFICATION_POSITION' => $config['notification_position'])
        );
    }
    if ($error == '') {
        // get nr of total hits
        $query = 'SELECT FOUND_ROWS() as `num_rows`';
        $resRows = $dbo->query($query, MsdDbFactory::ARRAY_OBJECT);
        $numRecordsTotal = $resRows[0]->num_rows;
        $_SESSION['num_records_total'] = $numRecordsTotal;
        $showHeader = true;
        if ($offset + $config['resultsPerPage'] > $numRecordsTotal) {
            $entryTo = $numRecordsTotal;
        } else {
            $entryTo = $offset + $config['resultsPerPage'];
        }
        $showing = sprintf(
            $lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z'],
            $offset + 1,
            $entryTo,
            $numRecordsTotal
        );
        $tplSqlbrowserSqlboxShowResults->assign_vars(
            array(
                'ICON_UP' => $icon['arrow_up'],
                'ICON_DOWN' => $icon['arrow_down'])
        );
        if ($numRecordsTotal > 0) {
            $forwardDisabled='';
            if ($offset + $config['resultsPerPage'] >= $numRecordsTotal) {
                $forwardDisabled = ' disabled="disabled"';
            }
            $backwardDisabled='';
            if ($offset == 0) {
                $backwardDisabled = ' disabled="disabled"';
            }

            $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                'PAGER', array(
                    'PAGE_FORWARD_DISABLED' => $forwardDisabled,
                    'PAGE_BACK_DISABLED' => $backwardDisabled,
                    'SHOWING_ENTRY_X_OF_Y' => $showing)
            );
        }
        $i = 0;
        foreach ($res as $row) {
            if ($showHeader) {
                // show Headline of table
                $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                    'HEADLINE', array()
                );

                foreach ($row as $field => $val) {
                    $nextOrderDirection = 'DESC';
                    if ($orderDirection == 'DESC') {
                        $nextOrderDirection = 'ASC';
                    }
                    $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                        'HEADLINE.FIELDS', array(
                            'NAME' => $field,
                            'FIELD_ENCODED' => base64_encode($field),
                            'DIRECTION' => $nextOrderDirection)
                    );
                    // show order icon
                    if ($field == $orderByField) {
                        if ($orderDirection == 'ASC') {
                            $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                                'HEADLINE.FIELDS.ICON_UP', array()
                            );
                        } else {
                            $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                                'HEADLINE.FIELDS.ICON_DOWN', array()
                            );
                        }
                    }
                    $showHeader = false;
                }
            }
            $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                'ROW', array(
                    'NR' => $i + 1 + $offset,
                    'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1')
            );
            foreach ($row as $field => $val) {
                $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                    'ROW.FIELD', array(
                        'VAL' => $val)
                );
                if (is_numeric($val)) {
                    $tplSqlbrowserSqlboxShowResults->assign_block_vars(
                        'ROW.FIELD.NUMERIC', array()
                    );
                }
            }
            $i++;
        }
    }
} else {
    $count = array(
        'create' => 0,
        'delete' => 0,
        'drop' => 0,
        'update' => 0,
        'insert' => 0,
        'select' => 0,
        'alter' => 0
    );

    $tplSqlbrowserSqlboxShowQueryResults = new MSDTemplate();
    $tplSqlbrowserSqlboxShowQueryResults->set_filenames(
        array(
            'tplSqlbrowserSqlboxShowQueryResults' =>
            'tpl/sqlbrowser/sqlbox/showQueryResults.tpl')
    );
    $tplSqlbrowserSqlboxShowQueryResults->assign_vars(
        array(
            'NOTIFICATION_POSITION' => $config['notification_position'])
    );
    $i = 0;
    foreach ($queries as $key => $query) {
        $skip = false;
        $compare = strtoupper(substr($query, 0, 4));
        switch ($compare)
        {
            case 'CREA':
                $count['create']++;
                break;
            case 'DROP':
                $count['drop']++;
                break;
            case 'UPDA':
                $count['update']++;
                break;
            case 'INSE':
                $count['insert']++;
                break;
            case 'SELE':
                $count['select']++;
                break;
            case 'ALTE':
                $count['alter']++;
                break;
            case 'DELE':
                $count['delete']++;
                break;

            default:
                if (substr($compare, 0, 2) == '--' ||
                    substr($compare, 0, 1) == '#') {
                        $skip = true;
                }
        }
        if (!$skip) {
            $start = getMicrotime();
            try
            {
                $res = $dbo->query($query, MsdDbFactory::SIMPLE);
            }
            catch (Exception $e)
            {
                $logMsg = '(' . $e->getCode() . ') ' . $e->getMessage();
                $tplSqlbrowserSqlboxShowQueryResults->assign_block_vars(
                    'ERROR', array(
                        'TEXT' => Html::getJsQuote($logMsg))
                );
            }

            $end = getMicrotime();
            $queries[$key]['time'] = $end - $start;
            $i++;
            $tplSqlbrowserSqlboxShowQueryResults->assign_block_vars(
                'SQL_COMMAND', array(
                    'SQL' => substr($query, 0, 100),
                    'EXEC_TIME' => $queries[$key]['time'],
                    'NR' => $i)
            );
        }

        $tplSqlbrowserSqlboxShowQueryResults->assign_vars(
            array(
                'COUNT_DROP' => String::formatNumber($count['drop']),
                'COUNT_DELETE' => String::formatNumber($count['delete']),
                'COUNT_CREATE' => String::formatNumber($count['create']),
                'COUNT_ALTER' => String::formatNumber($count['alter']),
                'COUNT_INSERT' => String::formatNumber($count['insert']),
                'COUNT_SELECT' => String::formatNumber($count['select']),
                'COUNT_UPDATE' => String::formatNumber($count['update']))
        );
    }
}
$_SESSION['sql']['statements'] = $sql['sql_statements'];
$_SESSION['sql']['order_by_field'] = $orderByField;
$_SESSION['sql']['order_direction'] = $orderDirection;
$_SESSION['sql']['offset'] = $offset;
