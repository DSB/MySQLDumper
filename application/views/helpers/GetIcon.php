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
class Msd_View_Helper_GetIcon  extends Zend_View_Helper_Abstract
{
    /**
     * Get html-img-tag for icon image
     *
     * @param string $name
     * @param string $title
     * @param int    $size
     *
     * @return string
     */
    public function getIcon($name, $title='', $size='')
    {
        static $baseUrl = false;
        if (!$baseUrl) {
            $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        }
        $icons = self::_getIconFilenames();
        if (!isset($icons[$name])) {
            throw new Msd_Exception(
                'GetIcon: unknown icon \''.$name .'\' requested'
            );
        }
        $config = Msd_Configuration::getInstance();
        $img = '<img src="'.$baseUrl.'/%s/%s" alt="%s" title="%s" />';
        if ($size>'') {
            $img = '<img src="'.$baseUrl.'/%s/%sx%s/%s" alt="%s" title="%s" />';
            $ret = sprintf(
                $img,
                $config->get('paths.iconpath'),
                $size,
                $size,
                $icons[$name],
                $title, $title
            );
        } else {
            $ret = sprintf(
                $img,
                $config->get('paths.iconpath'),
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
    private function _getIconFilenames ()
    {
        static $icons = false;
        if (!$icons) {
            $config = Msd_Configuration::getInstance();
            $file = realpath(
                APPLICATION_PATH . DS . '..' . DS . 'public'
                . DS . $config->get('paths.iconpath') . DS . 'icon.ini'
            );
            $iconsIni = new Zend_Config_Ini($file, 'icons');
            $icons = $iconsIni->toArray();
            unset($iconsIni);
        }
        return $icons;
    }

}
