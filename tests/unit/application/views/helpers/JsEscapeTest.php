<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'JsEscape.php';

/**
 * @group MsdViewHelper
 */
class JsEscapeTest extends PHPUnit_Framework_TestCase
{
    public function testJsEscapeWithQuotes()
    {
        $expected = "test\'with\'quotes\'";
        $viewHelper = new Msd_View_Helper_JsEscape();
        $res = $viewHelper->jsEscape("test'with'quotes'");
        $this->assertEquals($expected, $res);
    }
}

