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
 * Check if engine of table supports optimization
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_IsTableOptimizable extends Zend_View_Helper_Abstract
{
    /**
     * Detect if the table engine allwos optimization.
     *
     * @param string $tableEngine The engine of the table
     *
     * @return boolean
     */
    public function isTableOptimizable($tableEngine)
    {
        $optimizable = array('MyISAM', 'InnoDB', 'ARCHIVE');
        if (in_array($tableEngine, $optimizable)) {
            return true;
        }
        return false;
    }
}