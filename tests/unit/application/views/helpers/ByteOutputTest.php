<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'ByteOutput.php';

/**
 * @group MsdViewHelper
 */

class ByteOutputTest extends PHPUnit_Framework_TestCase
{
    public function testByteOutputWithoutHtml()
    {
        $expected='1.00 KB';
        $viewHelper = new Msd_View_Helper_ByteOutput();
        $res = $viewHelper->byteOutput(1024, 2, false);
        $this->assertEquals($expected, $res);
    }

    public function testByteOutputWithHtml()
    {
        $expected = '1.00 <span class="explain tooltip" title="KiloBytes">KB</span>';
        $viewHelper = new Msd_View_Helper_ByteOutput();
        $res = $viewHelper->byteOutput(1024, 2, true);
        $this->assertEquals($expected, $res);
    }

    public function testByteOutputWithNonNumericValue()
    {
        $expected = 'I am not a number';
        $viewHelper = new Msd_View_Helper_ByteOutput();
        $res = $viewHelper->byteOutput($expected, 2, true);
        $this->assertEquals($expected, $res);
    }
}

