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
/**
 * Read list of backups in work/backup and create selectbox.
 *
 * Used in backup converter.
 *
 * @param string $selected selected file
 * @return string String containing HTML-selectbox ready to output
 */
function getFilelisteCombo($selected)
{
    global $config;
    $files = array();
    $dir = new DirectoryIterator($config['paths']['backup']);
    foreach ($dir as $fileinfo)
    {
        $file = $fileinfo->getFilename();
        if ($file[0] != '.' && $fileinfo->isFile())
        {
            $size = byteOutput($fileinfo->getSize());
            $files["$file"] = $file . ' (' . $size . ')';
        }
    }
    ksort($files);
    $r = Html::getOptionlist($files, $selected);
    return $r;
}

/**
 * Reformat a date from format dd.mm.yyyy hh:mm to yyyy.mm.dd hh:mm to make it sortable.
 *
 * @param string $datum Datetime taken from filename
 * @return string
 */
function getSortableDate($datum)
{
    $p = explode(' ', $datum);
    $uhrzeit = $p[1];
    $p2 = explode('.', $p[0]);
    $day = $p2[0];
    $month = $p2[1];
    $year = $p2[2];
    return $year . '.' . $month . '.' . $day . ' ' . $uhrzeit;
}

/**
 * Checks a dump file and converts it.
 *
 * Places field names in backticks and splitts files into 10 MB-Parts.
 *
 * @param string $filesource File to convert
 * @param string $db_name    Database name will be used to create filenames and statusline
 * @param string $cp         Target copy file
 * @return void
 */
function convert($filesource, $db_name, $cp)
{
    global $config, $lang;
    @ini_set('max_input_time', '0'); // for real big dumps


    $filesize = 0;
    $max_filesize = 1024 * 1024 * 10; //10 MB splitsize
    $part = 1;
    $cps = (substr(strtolower($filesource), -2) == "gz") ? 1 : 0;
    // we compare the string size with this value (not the real filesie)
    //so if file is compressed we need to adjust it
    if ($cps == 1) $max_filesize *= 7;

    $filedestination = $db_name . '_' . date("Y_m_d_H_i", time());
    echo "<h5>" . sprintf($lang['L_CONVERT_FILEREAD'], $filesource) . ".....</h5><span style=\"font-size:10px;\">";
    if (file_exists($config['paths']['backup'] . $filedestination)) unlink($config['paths']['backup'] . $filedestination);
    $f = ($cps == 1) ? gzopen($config['paths']['backup'] . $filesource, "r") : fopen($config['paths']['backup'] . $filesource, "r");
    $z = ($cp == 1) ? gzopen($config['paths']['backup'] . $filedestination . '_part_1.sql.gz', "w") : fopen($config['paths']['backup'] . $filedestination . '_part_1.sql', "w");

    $zeile = getPseudoStatusline($part, $db_name) . "\r\n";
    ($cp == 1) ? gzwrite($z, $zeile) : fwrite($z, $zeile);
    $zeile = '';
    flush();

    $insert = $mode = "";
    $n = 0;
    $eof = ($cps == 1) ? gzeof($f) : feof($f);
    $splitable = false; // can the file be splitted? Try to avoid splitting before a command is completed
    WHILE (!$eof)
    {
        flush();
        $eof = ($cps == 1) ? gzeof($f) : feof($f);
        $zeile = ($cps == 1) ? gzgets($f, 5144000) : fgets($f, 5144000);

        $t = strtolower(substr($zeile, 0, 10));
        if ($t > '')
        {
            switch ($t)
            {
                case 'insert int':
                    {
                        // eine neue Insert Anweisung beginnt
                        if (strpos($zeile, '(') === false)
                        {
                            //Feldnamen stehen in der naechsten Zeile - holen
                            $zeile .= "\n\r";
                            $zeile .= ($cps == 1) ? trim(gzgets($f, 8192)) : trim(fgets($f, 8192));
                            $zeile .= ' ';
                        }

                        // get INSERT-Satement
                        $insert = substr($zeile, 0, strpos($zeile, '('));
                        if (substr(strtoupper($insert), -7) != 'VALUES ') $insert .= ' VALUES ';
                        $mode = 'insert';
                        $splitable = false;
                        break;
                    }

                case 'create tab':
                    {
                        $mode = 'create';
                        WHILE (substr(rtrim($zeile), -1) != ';')
                        {
                            $zeile .= fgets($f, 8192);
                        }
                        $zeile = setBackticks($zeile) . "\n\r";
                        $splitable = true;
                        break;
                    }
            }
        }

        if ($mode == 'insert')
        {
            if (substr(rtrim($zeile), strlen($zeile) - 3, 2) == ');') $splitable = true;

            // Komma loeschen
            $zeile = str_replace('),(', ");\n\r" . $insert . ' (', $zeile);
        }

        if ($splitable == true && $filesize > $max_filesize) // start new file?
        {
            $part++;
            if ($mode == 'insert') // Insert -> first complete Insert-Statement, then begin new file
            {
                if ($cp == 1)
                {
                    gzwrite($z, $zeile);
                    gzclose($z);
                    $z = gzopen($config['paths']['backup'] . $filedestination . '_part_' . $part . '.sql.gz', "w");
                    $zeile = getPseudoStatusline($part, $db_name) . "\r\n";
                    gzwrite($z, $zeile);
                    $zeile = '';
                }
                else
                {
                    fwrite($z, $zeile);
                    fclose($z);
                    $z = fopen($config['paths']['backup'] . $filedestination . '_part_' . $part . '.sql', "w");
                    $zeile = getPseudoStatusline($part, $db_name) . "\r\n";
                    gzwrite($z, $zeile);
                    $zeile = '';
                }
            }
            else // first close last file, then begin new one and write new beginning command
            {
                if ($cp == 1)
                {
                    gzclose($z);
                    $z = gzopen($config['paths']['backup'] . $filedestination . '_part_' . $part . '.sql.gz', "w");
                    $zeile = getPseudoStatusline($part, $filedestination) . "\r\n" . $zeile;
                    gzwrite($z, $zeile);
                }
                else
                {
                    fclose($z);
                    $z = fopen($config['paths']['backup'] . $filedestination . '_part_' . $part . '.sql', "w");
                    $zeile = getPseudoStatusline($part, $filedestination) . "\r\n" . $zeile;
                    fwrite($z, $zeile);
                }
                $n = 0;
            }
            $filesize = 0;
            $splitable = false;
        }
        else // no, append to actual file
        {
            $filesize += strlen($zeile);
            if ($n > 200)
            {
                $n = 0;
                echo '<br />';
            }
            echo '.';
            if ($cps == 1) gzwrite($z, $zeile);
            else fwrite($z, $zeile);
            flush();
        }
        $n++;
    }
    $zeile = "\n-- EOB";
    if ($cps == 1)
    {
        gzwrite($z, $zeile);
        gzclose($z);
    }
    else
    {
        fwrite($z, $zeile);
        fclose($z);
    }

    if ($cps == 1) gzclose($f);
    else fclose($f);
    echo '</span><h5>' . sprintf($lang['L_CONVERT_FINISHED'], $filedestination) . '</h5>';
}

/**
 * Create a dummy statusline.
 *
 * Used when converting a file, to create a legal MSD-Multipart-File.
 *
 * @param integer $part
 * @param string  $db_name
 * @return string
 */
function getPseudoStatusline($part, $db_name)
{
    if ($part > 1) echo '<br />Continue with part: ' . $part . '<br />';
    $ret = '-- Status:-1:-1:MP_' . ($part) . ':' . $db_name . ":php:converter2:converted:unknown:1:::latin1:EXTINFO\r\n" . "-- TABLE-INFO\r\n" . "-- TABLE|unknown|0|0|2009-01-24 20:39:39\r\n" . "-- EOF TABLE-INFO\r\n";
    return $ret;
}

/**
 * Read information from all backup files in folder work/backup and return multidimensional array
 * containing all info.
 *
 * @return array
 */
function getBackupfileInfo()
{
    global $config;
    clearstatcache();
    $files = Array();
    $dh = opendir($config['paths']['backup']);
    while (false !== ($filename = readdir($dh)))
    {
        if ($filename != '.' && $filename != '..' && !is_dir($config['paths']['backup'] . $filename))
        {
            $files[]['name'] = $filename;
        }
    }
    $arrayindex = 0;
    $total_filesize = 0;
    $db_backups = array();
    $db_summary_anzahl = array();
    $db_summary_last = array();
    if (count($files) > 0)
    {
        for ($i = 0; $i < sizeof($files); $i++)
        {
            // filesize
            $size = filesize($config['paths']['backup'] . $files[$i]['name']);
            $file_datum = date("d\.m\.Y H:i", filemtime($config['paths']['backup'] . $files[$i]['name']));
            $statusline = ReadStatusline($files[$i]['name']);
            $backup_timestamp = GetTimestampFromFilename($files[$i]['name']);
            $pathinfo = pathinfo($files[$i]['name']);
            $file_extension = $pathinfo['extension'];
            if ($backup_timestamp == '') $backup_timestamp = $file_datum;
            $database_name = $statusline['dbname'];

            // check for some special cases
            if ($database_name == 'unknown') $database_name = '~unknown'; // needed for sorting - place unknown files at the end
            if ($statusline['comment'] == 'converted') $database_name = '~converted'; // converted fiels


            //jetzt alle in ein Array packen
            if ($statusline['part'] == 'MP_0' || $statusline['part'] == '')
            {
                $db_backups[$arrayindex]['name'] = $files[$i]['name'];
                $db_backups[$arrayindex]['db'] = $database_name;
                $db_backups[$arrayindex]['extension'] = $file_extension;
                $db_backups[$arrayindex]['size'] = $size;
                $db_backups[$arrayindex]['date'] = $backup_timestamp;
                $db_backups[$arrayindex]['sort'] = getSortableDate($backup_timestamp);
                $db_backups[$arrayindex]['tables'] = $statusline['tables'];
                $db_backups[$arrayindex]['records'] = $statusline['records'];
                $db_backups[$arrayindex]['multipart'] = 0;
                $db_backups[$arrayindex]['comment'] = $statusline['comment'];
                $db_backups[$arrayindex]['script'] = ($statusline['script'] != '') ? $statusline['script'] . '(' . $statusline['scriptversion'] . ')' : '';
                $db_backups[$arrayindex]['charset'] = $statusline['charset'];
                $db_backups[$arrayindex]['mysqlversion'] = $statusline['mysqlversion'];
                if (!isset($db_summary_last[$database_name])) $db_summary_last[$database_name] = $backup_timestamp;
                $db_summary_anzahl[$database_name] = (isset($db_summary_anzahl[$database_name])) ? $db_summary_anzahl[$database_name] + 1 : 1;
                $db_summary_size[$database_name] = (isset($db_summary_size[$database_name])) ? $db_summary_size[$database_name] + $size : $size;
                if (getSortableDate($backup_timestamp) > getSortableDate($db_summary_last[$database_name])) $db_summary_last[$database_name] = $backup_timestamp;
            }
            else
            {
                //v($statusline);
                //list multipart files only once but keep info how many files belong to this backup
                $done = 0;
                if (!isset($db_summary_size[$database_name])) {
                    $db_summary_size[$database_name] = 0;
                }
                for ($j = 0; $j < $arrayindex; $j++)
                {
                    if (isset($db_backups[$j]))
                    {
                        if (($db_backups[$j]['date'] == $backup_timestamp) && $db_backups[$j]['db'] == $database_name && $db_backups[$j]['extension'] == $file_extension)
                        {
                            $db_backups[$j]['mysqlversion'] = $statusline['mysqlversion'];
                            $db_backups[$j]['multipart']++;
                            $db_backups[$j]['size'] += $size; // calculate size for this multipart backup
                            $db_summary_size[$database_name] += $size; // calculate total size for this database
                            $done = 1;
                            break;
                        }
                    }
                }
                if ($done == 1) $arrayindex--;

                if ($done == 0)
                {
                    //new entry for this backup with this timestamp
                    $db_backups[$arrayindex]['name'] = $files[$i]['name'];
                    $db_backups[$arrayindex]['db'] = $database_name;
                    $db_backups[$arrayindex]['extension'] = $file_extension;
                    $db_backups[$arrayindex]['size'] = $size;
                    $db_backups[$arrayindex]['date'] = $backup_timestamp;
                    $db_backups[$arrayindex]['sort'] = getSortableDate($backup_timestamp);
                    $db_backups[$arrayindex]['tables'] = $statusline['tables'];
                    $db_backups[$arrayindex]['records'] = $statusline['records'];
                    $db_backups[$arrayindex]['multipart'] = 1;
                    $db_backups[$arrayindex]['comment'] = $statusline['comment'];
                    $db_backups[$arrayindex]['script'] = ($statusline['script'] != "") ? $statusline['script'] . "(" . $statusline['scriptversion'] . ")" : "";
                    $db_backups[$arrayindex]['charset'] = $statusline['charset'];

                    if (!isset($db_summary_last[$database_name])) $db_summary_last[$database_name] = $backup_timestamp;
                    $db_summary_anzahl[$database_name] = (isset($db_summary_anzahl[$database_name])) ? $db_summary_anzahl[$database_name] + 1 : 1;
                    $db_summary_size[$database_name] = (isset($db_summary_size[$database_name])) ? $db_summary_size[$database_name] + $size : $size;
                    if (getSortableDate($backup_timestamp) > getSortableDate($db_summary_last[$database_name])) $db_summary_last[$database_name] = $backup_timestamp;
                }
            }
            $arrayindex++;
            $total_filesize += $size; // calculate overall file size
        }
    }
    if ((isset($db_backups)) && (is_array($db_backups))) $db_backups = arfsort($db_backups, get_orderarray('sort,d|name,A'));
    // merge infos into one array
    $info = array();
    $info['filesize_total'] = $total_filesize; // total size of all files
    $info['files'] = $db_backups; // info per file
    unset($db_backups);
    $info['databases'] = array();
    foreach ($db_summary_anzahl as $db => $count)
    {
        $info['databases'][$db]['backup_count'] = $count;
        $info['databases'][$db]['backup_size_total'] = $db_summary_size[$db];
        $info['databases'][$db]['latest_backup_timestamp'] = $db_summary_last[$db];
    }
    return $info;
}
