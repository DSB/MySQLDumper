<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'NumberFormat.php';

/**
 * @group MsdViewHelper
 */
class NumberFormatTest extends PHPUnit_Framework_TestCase
{
    public function testFormatNumberWithoutPrecision()
    {
        $viewHelper = new Msd_View_Helper_NumberFormat();
        $res = $viewHelper->numberFormat(24.123456);
        $this->assertEquals('24', $res);
    }

    public function testFormatNumberWithPrecision()
    {
        $viewHelper = new Msd_View_Helper_NumberFormat();
        $res = $viewHelper->numberFormat(24.12356789, 3);
        $this->assertEquals('24,124', $res);
    }
    
    public function testFailFormatNumberConversionToFloat()
    {
        $viewHelper = new Msd_View_Helper_NumberFormat();
        $res = $viewHelper->numberFormat('AAA', 3);
        $this->assertEquals('0,000', $res);
    }
}

