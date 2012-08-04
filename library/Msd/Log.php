<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Log
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Log Class
 *
 * @package         MySQLDumper
 * @subpackage      Log
 */
class Msd_Log
{
    // Define constants
    const PHP           = 'PHP-Log';
    const PERL          = 'PERL-Log';
    const PERL_COMPLETE = 'PERL-Complete-Log';
    const ERROR         = 'Error-Log';

    // Define static Instance
    private static $_instance = NULL;
    private $_paths = NULL;

    /**
     * Init file handles
     *
     * @return Msd_Log
     */
    public function __construct()
    {
        // define instance handler
        $this->handle                      = array();
        $this->handle[self::PHP]           = false;
        $this->handle[self::PERL]          = false;
        $this->handle[self::PERL_COMPLETE] = false;
        $this->handle[self::ERROR]         = false;

        $config       = Msd_Registry::getConfig();
        $this->_paths = (object)$config->getParam('paths');
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
     * Close a filehandle
     *
     * @param Loge $file The file to close
     */
    private function _close($file)
    {
        $filename  = $this->getFile($file);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension == 'gz') {
            gzclose($this->handle[$file]);
        } else {
            fclose($this->handle[$file]);
        }
    }

    /**
     * Get an instance of Msd_Log
     *
     * @return Msd_Log
     */
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Get an instance of Msd_Log for a special type
     *
     * Allowed types are self::PHP, self::PERL, self::PERL_COMPLETE or
     * self::ERROR
     *
     * @param Msd_Log $type
     *
     * @return Msd_Log
     */
    public function getLogInstance($type)
    {
        if (!isset($this->_logInstance[$type])) {
            $writer    = new Zend_Log_Writer_Stream($this->getFile($type));
            $formatter =
                new Zend_Log_Formatter_Simple("%timestamp% %message%\n");
            $writer->setFormatter($formatter);
            $this->_logInstance[$type] = new Zend_Log($writer);
        }
        return $this->_logInstance[$type];
    }

    /**
     * Write to log file
     *
     * @param string $type    The type of log file to write to
     * @param string $message The message to add to the file
     *
     * @return bool
     */
    public static function write($type, $message)
    {
        // @todo if log_maxsize reached => archive/delete log
        $logger = self::getInstance();
        $log    = $logger->getLogInstance($type);
        return $log->info($message);
    }

    /**
     * Get the concrete filename with path for the given type.
     *
     * @param const $file
     *
     * @return string Filename of logfile
     */
    public function getFile($file)
    {
        $filename = '';
        switch ($file) {
            case self::PHP:
                $filename = $this->_paths->log . '/php.log';
                break;
            case self::PERL:
                $filename = $this->_paths->log . '/perl.log';
                break;
            case self::PERL_COMPLETE:
                $filename = $this->_paths->log . '/perlComplete.log';
                break;
            case self::ERROR:
                $filename = $this->_paths->log . '/phpError.log';
        }
        return $filename;
    }

    /**
     * Delete a log file and recreate it.
     *
     * @param string $type Filename
     *
     * @return void
     */
    public function delete($type)
    {
        $filename = self::getFile($type);
        @unlink($filename);
        // re-create log file
        $translator = Msd_Language::getInstance()->getTranslator();
        $this->write($type, $translator->_('L_LOG_CREATED'));
    }

    /**
     * Read a logfile and return content as array.
     *
     * If $revers is set to true the ordering of lines is reversed.
     *
     * @param string $type    The type of logfile to read
     * @param bool   $reverse Whether to place latest entries first
     *
     * @return array Log data from file as array
     */
    public function read($type = self::PHP, $reverse = false)
    {
        $filename = $this->getFile($type);
        if (!is_readable($filename)) {
            $timestamp = Zend_Date::ISO_8601;
            $lang      = Msd_Language::getInstance()->getTranslator();
            $msg       = $timestamp . ' <span class="error">' .
                sprintf($lang->_('L_LOG_NOT_READABLE'), $filename) . '</span>';
            return array($msg);
        } else {
            $output = file($filename);
        }
        if ($reverse == 1) {
            $output = array_reverse($output);
        }

        return $output;
    }
}
