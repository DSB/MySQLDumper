<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Sql
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Config Validator
 *
 * Model to validate configuration values set in config form
 *
 * @package         MySQLDumper
 * @subpackage      Sqlbox
 */
class Application_Model_Sqlbox
{
    public function getTableSelectBox()
    {
        $this->_db = Msd_Db::getAdapter();
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        $db = $dynamicConfig->getParam('dbActual');
        $tableNames = $this->_db->getTables($db);
        $options = array();
        foreach ($tableNames as $table) {
            $options[$table] = $table;
        }
        return Msd_Html::getHtmlOptions($options, '');
    }
}
