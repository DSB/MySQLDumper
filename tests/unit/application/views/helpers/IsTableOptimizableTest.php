<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'IsTableOptimizable.php';

/**
 * @group MsdViewHelper
 */
class IsTableOptimizableTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if helper returns true for MyIsam-Engine
     */
    public function testIsTableOptimizable()
    {
        $viewHelper = new Msd_View_Helper_IsTableOptimizable();
        $res = $viewHelper->isTableOptimizable('MyISAM');
        $this->assertEquals(true, $res);
    }
    
    /**
     * Tests if helper returns false for CSV-Engine
     */
    public function testFailIsTableOptimizable()
    {
        $viewHelper = new Msd_View_Helper_IsTableOptimizable();
        $res = $viewHelper->isTableOptimizable('CSV');
        $this->assertEquals(false, $res);
    }
}

