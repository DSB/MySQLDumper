<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Get img-tag for icon
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_GetIcon extends Zend_View_Helper_Abstract
{
    /**
     * Get html-img-tag for icon image
     *
     * @throws Msd_Exception
     *
     * @param string $name  Icon name
     * @param string $title HTML title tag
     * @param int    $size Size in Pixel (defines the sub folder to load from)
     *
     * @return string
     */
    public function getIcon($name, $title = '', $size = null)
    {
        static $baseUrl = false;
        if (!$baseUrl) {
            $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        }
        $icons = $this->_getIconFilenames();
        if (!isset($icons[$name])) {
            throw new Msd_Exception(
                'GetIcon: unknown icon \'' . $name . '\' requested'
            );
        }
        $img    = '<img src="' . $baseUrl . '/%s/%s" alt="%s" title="%s" />';
        $config = Msd_Registry::getConfig();
        if ($size !== null) {
            $img = '<img src="' . $baseUrl . '/%s/%sx%s/%s" alt="%s" title="%s" />';
            $ret = sprintf(
                $img,
                $config->getParam('paths.iconPath'),
                $size,
                $size,
                $icons[$name],
                $title, $title
            );
        } else {
            $ret = sprintf(
                $img,
                $config->getParam('paths.iconPath'),
                $icons[$name],
                $title,
                $title
            );
        }
        return $ret;
    }

    /**
     * Get default values from defaultConfig.ini
     *
     * @return object
     */
    private function _getIconFilenames()
    {
        static $icons = false;
        if (!$icons) {
            $config   = $this->view->config;
            $file     = realpath(
                APPLICATION_PATH . '/../public/'
                . $config->getParam('paths.iconPath') . '/icon.ini'
            );
            $iconsIni = new Zend_Config_Ini($file, 'icons');
            $icons    = $iconsIni->toArray();
            unset($iconsIni);
        }
        return $icons;
    }
}
