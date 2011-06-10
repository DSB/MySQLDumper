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
 * Helper for returning the absolute URL including scheme and serveraddress
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_AbsoluteUrl extends Zend_View_Helper_Abstract
{
    /**
     * Build an absolute URL (@see Zend_View_Helper_Url::url())
     * @param array $urlOptions
     * @param null $name
     * @param bool $reset
     * @param bool $encode
     * @return string
     */
    public function absoluteUrl(
        array $urlOptions = array(),
        $name = null,
        $reset = false,
        $encode = true
    )
    {
        $serverUrlViewHelper = new Zend_View_Helper_ServerUrl();
        $urlViewHelper = new Zend_View_Helper_Url();
        $url = $urlViewHelper->url($urlOptions, $name, $reset, $encode);

        $absoluteUrl = $serverUrlViewHelper->serverUrl($url);

        return $absoluteUrl;
    }
}
