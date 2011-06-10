<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $Rev$
 * @author          $Author$
 * @lastmodified    $Date$
 */
/**
 * Log Class
 */
class Log
{
    // Define constants
    const PHP =             1;
    const PERL =            2;
    const PERL_COMPLETE =   3;
    const ERROR =           4;

    const PHP_FILE = 'work/log/mysqldump.log';
    const PERL_FILE = 'work/log/mysqldump_perl.log';
    const PERL_COMPLETE_FILE = 'work/log/mysqldump_perl.complete.log';
    const ERROR_FILE = 'work/log/error.log';

    /**
     * Init file handles
     *
     * @return void
     */
    public function __construct()
    {
        $this->handle = array();
        $this->handle[self::PHP] = false;
        $this->handle[self::PERL] = false;
        $this->handle[self::PERL_COMPLETE] = false;
        $this->handle[self::ERROR] = false;
    }
    /**
     * Close all open file handles on destruct
     *
     * @return void
     */
    public function __destruct()
    {
        if ($this->handle[self::PHP]) {
            $this->_close(self::PHP);
        }
        if (is_resource($this->handle[self::PERL])) {
            $this->_close(self::PERL);
        }
        if (is_resource($this->handle[self::PERL_COMPLETE])) {
            $this->_close(self::PERL_COMPLETE);
        }
       if (is_resource($this->handle[self::ERROR])) {
            $this->_close(self::ERROR);
       }
    }

    /**
     * Open file and store file handle
     *
     * @param string $file
     *
     * @return bool
     */
    private function _getFileHandle($file)
    {
        $filename=$this->getLogfile($file);
        if ($_SESSION['config']['logcompression'] == 1) {
            $fileHandle = @gzopen($filename, 'a');
        } else {
            $fileHandle = @fopen($filename, 'ab');
        }
        if ($fileHandle) {
            $this->handle[$file] = $fileHandle;
            return $this->handle[$file];
        } else {
            return false;
        }
    }
    /**
     * Close a filehandle
     *
     * @param Loge $file The file to close
     */
    private function _close($file)
    {
        $filename=$this->getLogfile($file);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension == 'gz') {
            gzclose($this->handle[$file]);
        } else {
            fclose($this->handle[$file]);
        }
    }
    /**
     * Write to log file
     *
     * @param string $file
     * @param string $message
     *
     * @return bool
     */
    public function write($file, $message)
    {
        // TODO get $config-values from a config class and delete global
        global $config;
        if (!$this->handle[$file]) {
            $this->handle[$file] = $this->_getFileHandle($file);
        }
        $message = strip_tags($message);
        // we don't need linebreaks in the log
        $search = array("\n","\r");
        $replace = array ('','');
        $message = str_replace($search, $replace, $message);
        $logMessage = date('d.m.Y H:i:s') . ' '. $message . "\n";
        $_SESSION['log']['actions'][] = $logMessage;
        $filename = $this->getLogfile($file);
        if (@filesize($filename) > $config['log_maxsize']) {
            Log::delete($file);
        }
        //save to log file
        if ($_SESSION['config']['logcompression'] == 1) {
            $res = @gzwrite($this->handle[$file], $logMessage);
        } else {
            $res = @fwrite($this->handle[$file], $logMessage);
        }
        return $res;
    }

    /**
     * Get log file name
     *
     * @param const $file
     *
     * @return string Filename of logfile
     */
    public function getLogfile($file)
    {
        switch ($file)
        {
            case Log::PHP:
                $filename = self::PHP_FILE;
                break;
            case Log::PERL:
                $filename = self::PERL_FILE;
                break;
            case Log::PERL_COMPLETE:
                $filename = self::PERL_COMPLETE_FILE;
                break;
            case Log::ERROR:
                $filename = self::ERROR_FILE;
                break;
            default:
                echo "Unknown $file: ".$file;
                return;
        }
        if ($_SESSION['config']['logcompression'] == 1) {
            $filename .= '.gz';
        }
        return $filename;
    }

    /**
     * Delete log file and recreates it.
     *
     * @param string $file      Filename
     *
     * @return void
     */
    public function delete($file)
    {
        $filename=Log::getLogfile($file);
        @unlink($filename);
        if ($file == Log::PHP) {
            // re-create main log
            if (substr($filename, -3) == '.gz') {
                $log = date('d.m.Y H:i:s') . " Log created.\n";
                if ($_SESSION['config']['logcompression'] == 1) {
                    $fp = @gzopen($filename, "wb");
                    @gzwrite($fp, $log);
                    @chmod($file . '.gz', 0777);
                    $this->handle[$file]=$fp;
                } else {
                    $fp = @fopen($filename, "wb");
                    @fwrite($fp, $log);
                    @chmod($file, 0777);
                    $this->handle[$file]=$fp;
                }
            }
        }
    }
}