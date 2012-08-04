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
     * Determines the escaping of the output.
     *
     * @var bool
     */
    private $_escapeIniOutput = true;

    /**
     * Class constructor
     *
     * @param array|string $options Configuration or filename of INI to load
     *
     * @return Msd_Ini
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
     * @throws Msd_Exception
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
     * @throws Msd_Exception
     *
     * @return bool
     */
    public function saveFile($filename = null)
    {
        if ($filename === null) {
            $filename = $this->_iniFilename;
        }
        if ($filename === null) {
            throw new Msd_Exception(
                'You must specify a filename to save the INI!'
            );
        }
        $res = file_put_contents($filename, (string) $this);
        return $res === false ? false : true;
    }

    /**
     * Converts an array into the INI file format.
     *
     * @param array   $array  Array to convert.
     * @param integer $level  Current depth level in the array.
     * @param string  $prefix Prefix to use for var name.
     *
     * @return string
     */
    private function _arrayToIniString($array = null, $level = -1, $prefix = '')
    {
        if ($array === null) {
            $array = $this->_iniData;
        }
        $level++;
        $resultString = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if ($level == 0) {
                    $resultString .= '[' . $key . ']' . "\n";
                    $resultString .= $this->_arrayToIniString($value, $level);
                } else {
                    $resultString .= $this->_arrayToIniString($value, $level, $key);
                }
            } else {
                $newValue = $value;
                if ($this->_escapeIniOutput) {
                    $newValue = "\"" . str_replace(
                        array('\\', '"'),
                        array('\\\\', '\\"'),
                        $value
                    ) . "\"";
                }

                $resultString .= ltrim("$prefix.$key", '.') . " = $newValue\n";
            }
        }

        if ($level < 2) {
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
     * Convert this class into a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_arrayToIniString();
    }

    /**
     * Sets the INI data.
     *
     * @param array $iniData New INI data.
     *
     * @return void
     */
    public function setIniData($iniData)
    {
        $this->_iniData = $iniData;
    }

    /**
     * Gets the parsed INI data.
     *
     * @return array
     */
    public function getIniData()
    {
        return $this->_iniData;
    }

    /**
     * Disables the escaping of the output for the INI file.
     *
     * @return void
     */
    public function disableEscaping()
    {
        $this->setEscapeIniOutput(false);
    }

    /**
     * Enables the escaping of the output for the INI file.
     *
     * @return void
     */
    public function enableEscaping()
    {
        $this->setEscapeIniOutput(true);
    }

    /**
     * En-/Disables the escaping of the output for the INI file.
     *
     * @param boolean $escapeIniOutput TRUE - Escaping enabled (default), FALSE - Escaping disabled
     *
     * @return void
     */
    public function setEscapeIniOutput($escapeIniOutput)
    {
        $this->_escapeIniOutput = $escapeIniOutput;
    }

    /**
     * Retrieves escaping status of the output for the INI file.
     *
     * @return boolean
     */
    public function getEscapeIniOutput()
    {
        return $this->_escapeIniOutput;
    }
}
