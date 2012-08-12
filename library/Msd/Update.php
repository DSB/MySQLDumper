<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Update
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Class handles loading of files from MySQLDumper update server.
 *
 * @package         MySQLDumper
 * @subpackage      Update
 */
class Msd_Update
{
    /**
     * Cofiguration for updater
     *
     * @var Msd_Ini
     */
    private $_updateConfig = null;

    /**
     * HTTP-Client for updates and update checks
     *
     * @var Zend_Http_Client
     */
    private $_httpClient = null;

    /**
     * Parameters for GET-Request.
     *
     * @var array
     */
    private $_requestParams = array();

    /**
     * Parameters for update information.
     *
     * @var array
     */
    private $_updateParams = array();

    /**
     * Class constructor
     *
     * @param array $updateConfigFile
     *
     * @return Msd_Update
     */
    public function __construct($updateConfigFile)
    {
        $this->_updateConfig = new Msd_Ini($updateConfigFile);
        $updateUrl = $this->_buildUpdateUrl();
        $this->_httpClient = new Zend_Http_Client($updateUrl);
    }

    /**
     * Start the update for the specified files.
     *
     * @param string $updateSection INI-Section with update information
     * @param array  $fileList      List of files to update.
     *
     * @return bool|array
     */
    public function doUpdate($updateSection, $fileList)
    {
        $httpClient = $this->_httpClient;
        $config = $this->_updateConfig->get($updateSection);
        $params = $this->getRequestParams();
        $params += $config['request']['params'];
        while (false !== (list($paramKey, $paramValue) = each($params))) {
            $params[$paramKey] = $this->_applyUpdateParams($paramValue);
        }

        $sourceFileKey = $config['request']['sourceFileKey'];
        $targetPath = $config['targetBaseDir'] . '/';
        foreach ($fileList as $sourceFile => $targetFile) {
            $sourceFilename = $this->_applyUpdateParams($sourceFile);
            $params[$sourceFileKey] = $sourceFile;
            $httpClient->setParameterGet($params);
            try {
                $response = $httpClient->request('GET');
            } catch(Zend_Http_Exception $e) {
                return array(
                    'action' => 'connection',
                    'file' => $targetFile,
                    'server' => $httpClient->getUri()->getHost()
                );
            }

            if ($response->getStatus() == 200 && $response->getBody() > '') {
                $targetFilename = $this->_applyUpdateParams($targetFile);
                if (substr($response->getBody(), 0, 6) == 'Error:') {
                    return array(
                        'action' => 'saveresponse',
                        'file' => $targetFilename,
                        'status' => $response->getBody(),
                    );
                }
                $targetFile = $targetPath . $targetFilename;
                @mkdir(dirname($targetFile), 0777, true);
                $fileHandle = @fopen($targetFile, 'w+');
                if ($fileHandle === false) {
                    @chmod($targetFile, 0777);
                    $fileHandle = @fopen($targetFile, 'w+');
                }
                if ($fileHandle === false) {
                    return array(
                        'action' => 'createfile',
                        'file' => $targetFile,
                        'status' => 'HTTP/' . $response->getVersion() . ' ' .
                            $response->getStatus() . ' ' .
                            $response->getMessage(),
                    );
                }
                if (@fwrite($fileHandle, $response->getBody()) === false) {
                    return array(
                        'action' => 'createfile',
                        'file' => $targetFile,
                        'status' => 'HTTP/' . $response->getVersion() . ' ' .
                            $response->getStatus() . ' ' .
                            $response->getMessage(),
                    );
                }
                fclose($fileHandle);
            } else {
                return array(
                    'action' => 'getrequest',
                    'file' => $sourceFilename,
                    'status' => 'HTTP/' . $response->getVersion() . ' ' .
                        $response->getStatus() . ' ' . $response->getMessage(),
                );
            }
        }
        return true;
    }

    /**
     * Build the URL for the GET-Requests.
     *
     * @return string
     */
    private function _buildUpdateUrl()
    {
        $updateConfig = $this->_updateConfig->get('update');
        $updateUrl  = $updateConfig['protocol'] . '://'
            . $updateConfig['host'] . $updateConfig['path']
            . $updateConfig['file'];
        $updateUrl = $this->_applyUpdateParams($updateUrl);
        return $updateUrl;
    }

    /**
     * Get the parameters for the GET-Request.
     *
     * @return array
     */
    public function getRequestParams()
    {
        return $this->_requestParams;
    }

    /**
     * Set an update information parameter.
     *
     * @param string $param Name of the parameter to set
     * @param string $value Value of the parameter to set
     *
     * @return void
     */
    public function setUpdateParam($param, $value)
    {
        $this->_updateParams[$param] = (string) $value;
    }

    /**
     * Applies the update information parameters to the given string.
     *
     * @param string $string String to apply the update information parameters
     *
     * @return string
     */
    private function _applyUpdateParams($string)
    {
        foreach ($this->_updateParams as $key => $value) {
            $string = str_replace(':' . $key, $value, $string);
        }
        return $string;
    }
}
