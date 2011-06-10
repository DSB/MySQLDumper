<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Ini
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Class to handle ini-files
 *
 * @package         MySQLDumper
 * @subpackage      Ini
 */
class Msd_Ini
{
    /**
     * Data of loaded INI file.
     *
     * @var array
     */
    private $_iniData = null;

    /**
     * Filename of current INI file.
     *
     * @var string
     */
    private $_iniFilename = null;

    /**
     * Class constructor
     *
     * @param array|string $options Configuration or filename of INI to load
     *
     * @return void
     */
    public function __construct($options = array())
    {
        if (is_string($options)) {
            $options = array(
                'filename' => $options,
            );
        } elseif (!is_array($options)) {
            $options = (array) $options;
        }

        if (isset($options['filename'])) {
            $this->_iniFilename = (string) $options['filename'];
        }
        if ($this->_iniFilename !== null) {
            $this->loadFile();
        }
    }

    /**
     * Loads an INI file.
     *
     * @param string $filename Name of file to load
     *
     * @return void
     */
    public function loadFile($filename = null)
    {
        if ($filename === null) {
            $filename = $this->_iniFilename;
        }

        if (realpath($filename) === false) {
            throw new Msd_Exception(
                "INI file " . $filename . "doesn't exists."
            );
        }
        $zfConfig = new Zend_Config_Ini(realpath($filename));
        $this->_iniData = $zfConfig->toArray();
    }

    /**
     * Save to INI file.
     *
     * @param string $filename Name of file to save
     *
     * @return void
     */
    public function save($filename = null)
    {
        if ($filename === null) {
            $filename = $this->_iniFilename;
        }
        if ($filename === null) {
            throw new Msd_Exception(
                'You must specify a filename to save the INI!'
            );
        }
        $fileHandle = fopen($filename, 'w+');
        fwrite($fileHandle, (string) $this);
        fclose($fileHandle);
    }

    /**
     * Converts an array into the INI file format.
     *
     * @param array   $array Array to convert.
     * @param integer $level Current depthlevel in the array.
     *
     * @return string
     */
    private function _arrayToIniString($array = null, $level = -1)
    {
        if ($array === null) {
            $array = $this->_iniData;
        }
        $level++;
        $resultString = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $resultString .= ($level == 0) ?
                    '[' . $key . ']' . "\n" :
                    $key . '.';
                $resultString .= $this->_arrayToIniString($value);
            } else {
                $newValue = str_replace(
                    array('\\', '"'),
                    array('\\\\', '\\"'),
                    $value
                );
                $resultString .= $key . ' = "' . (string) $newValue . '"';
            }
            $resultString .= "\n";
        }

        return $resultString;
    }

    /**
     * Get a variable from the data.
     *
     * @param string $key     Name of variable
     * @param string $section Name of section
     *
     * @return mixed
     */
    public function get($key, $section = null)
    {
        if ($section === null) {
            return $this->_iniData[$key];
        } else {
            return $this->_iniData[$section][$key];
        }

    }

    /**
     * Set a variable
     *
     * @param string $key     Name of variable
     * @param mixed  $value   Value of variable
     * @param string $section Section of variable
     *
     * @return void
     */
    public function set($key, $value, $section = null)
    {
        if ($section === null) {
            $this->_iniData[$key] = $value;
        } else {
            $this->_iniData[$section][$key] = $value;
        }
    }

    /**
     * Get the complete INI.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->_iniData;
    }

    /**
     * Convert this class into a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_arrayToIniString();
    }
}
