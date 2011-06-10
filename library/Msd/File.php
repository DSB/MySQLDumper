<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      File
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */
/**
 * File-Helper Class
 *
 * Class offers some methods for file handling
 *
 * @package         MySQLDumper
 * @subpackage      File
 */
class Msd_File
{
    /**
     * Get CHMOD of a file
     *
     * @param string $file The file to get chmod for
     *
     * @return int
     */
    public static function getChmod($file)
    {
        clearstatcache();
        return @substr(decoct(fileperms($file)), -3);
    }

    /**
     * Detects if file or directory is writable and trys to chmod it.
     *
     * Returns if file or directory is writable after chmodding.
     *
     * @param string $path
     * @param string $chmod
     *
     * @return bool
     */
    public static function isWritable($path, $chmod)
    {
        $fileValidator = new Msd_Validate_File_Accessible(
            array('accessType' => array('write'))
        );
        if (!$fileValidator->isValid($path)) {
            @chmod($path, $chmod);
        }
        return $fileValidator->isValid($path);
    }
    /**
     * Get information of latest backup file
     *
     * @return array
     */
    public static function getLatestBackupInfo()
    {
        $config = Msd_Configuration::getInstance();
        $latestBackup = array();
        $dir = new DirectoryIterator($config->get('paths.backup'));
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $fileMtime = $file->getMTime();
                if (!isset($latestBackup['mtime']) ||
                    $fileMtime > $latestBackup['mtime']) {
                    $filename = $file->getFilename();
                    $latestBackup['filename'] = $filename;
                    $latestBackup['fileMtime'] = date("d.m.Y H:i", $fileMtime);
                }
            }
        }
        return $latestBackup;
    }

    /**
     * Returns an array with the names of all saved configuration files
     *
     * Strips extensions.
     *
     * @return array List of configuration names
     */
    public static function getConfigNames()
    {
        $config = Msd_Configuration::getInstance();
        $configPath = $config->get('paths.config');
        if (!is_readable($configPath)) {
            return array();
        }
        $dir = new DirectoryIterator($configPath);
        $files = array();
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $filename = $file->getFilename();
                if (substr($filename, -4) == '.ini') {
                    $files[] = substr($filename, 0, - 4);
                }
            }
        }
        @sort($files);
        return $files;
    }

    /**
     * Get list of available themes.
     *
     * @return array
     */
    public static function getThemeList()
    {
        $dir = new DirectoryIterator(APPLICATION_PATH . '/../public/css/');
        $themes = array();
        while ($dir->valid()) {
            $current = $dir->current();
            if ($current->isDir() &&
                !$current->isDot() &&
                $current->getBasename() != '.svn'
            ) {
                $themeName= $current->getBasename();
                $themes[$themeName] = $themeName;
            }
            $dir->next();
        }

        return $themes;
    }

}
