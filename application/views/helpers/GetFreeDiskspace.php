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
 * Get free disk space
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_GetFreeDiskspace  extends Zend_View_Helper_Abstract
{
    /**
     * Get free diskspace
     *
     * @return string
     */
    public function getFreeDiskspace()
    {
        $lang = Msd_Language::getInstance()->getTranslator();
        $ret = $lang->_('L_NOTAVAIL');
        $dfs = @diskfreespace(APPLICATION_PATH);
        if ($dfs) {
            $ret = $this->view->byteOutput($dfs);
        }
        return $ret;
    }
}
