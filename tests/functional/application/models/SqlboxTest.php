<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once APPLICATION_PATH . DS . implode(DS, array('models', 'Sqlbox.php'));

/**
 * @group Models
 */

class SqlboxTest extends ControllerTestCase
{
    public function testCanCreateTableSelectBox()
    {
        $model = new Application_Model_Sqlbox();
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        $dynamicConfig->setParam('dbActual', 'information_schema');
        $selectBox = $model->getTableSelectBox();
        $tables = array('CHARACTER_SETS', 'COLLATIONS', 'COLLATION_CHARACTER_SET_APPLICABILITY',
             'COLUMNS', 'COLUMN_PRIVILEGES', 'ENGINES'
        );
        $pattern = '<option value="%1$s">%1$s</option>';
        foreach ($tables as $table) {
            $val = sprintf($pattern, $table);
            $this->assertTrue(strpos($selectBox, $val) !== false);
        }
    }
}

