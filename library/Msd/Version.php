<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Version
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Show MySQLDumper's version number
 *
 * @package         MySQLDumper
 * @subpackage      Version
 */
class Msd_Version
{
    /**
     * Current application version
     * @var string
     */
    private $_msdVersion = '2.0.0';

    /**
     * Minimum version of PHP which is required.
     *
     * @var string
     */
    private $_requiredPhpVersion = '5.2.0';

    /**
     * Minimum version of MySQL which is required.
     *
     * @var string
     */
    private $_requiredMysqlVersion = '4.1.2';

    /**
     * Constructor
     *
     * @param array $options Option-array to overwrite required PHP/MySQL
     *                       versions
     *
     * @return void
     */
    public function __construct($options = array())
    {
        if (isset($options['requiredPhpVersion'])) {
            $this->_requiredPhpVersion = $options['requiredPhpVersion'];
        }

        if (isset($options['requiredMysqlVersion'])) {
            $this->_requiredMysqlVersion = $options['requiredMysqlVersion'];
        }
    }

    /**
     * Get actual MySQLDumper version
     *
     * @return string The version number of MySQLDumper
     */
    public function getMsdVersion()
    {
        return $this->_msdVersion;
    }

    /**
     * Get required PHP version
     *
     * @return string The required version number of PHP
     */
    public function getRequiredPhpVersion()
    {
        return $this->_requiredPhpVersion;
    }
    /**
     * Get required MySQL version
     *
     * @return string The required version number of MySQL
     */
    public function getRequiredMysqlVersion()
    {
        return $this->_requiredMysqlVersion;
    }

    /**
     * Checks for required PHP version.
     *
     * @return boolean
     */
    public function checkPhpVersion()
    {
        $res = version_compare(PHP_VERSION, $this->_requiredPhpVersion);
        if ($res >= 0) {
            return true;
        }
        return false;
    }

    /**
     * Checks for required MySQL version.
     *
     * @return boolean
     */
    public function checkMysqlVersion()
    {
        $dbObject = Msd_Db::getAdapter();
        $mysqlVersion = $dbObject->getServerInfo();
        $res = version_compare(
            $mysqlVersion,
            $this->_requiredMysqlVersion
        );
        if ($res >= 0) {
            return true;
        }
        return false;
    }
}
