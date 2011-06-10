<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'GetIconSrc.php';

/**
 * @group MsdViewHelper
 */
class GetIconSrcTest extends PHPUnit_Framework_TestCase
{
    public function testGetIconSrcForIconWithoutSize()
    {
        $expected = '/css/msd/icons/openfile.gif';
        $viewHelper = new Msd_View_Helper_GetIconSrc();
        $res = $viewHelper->getIconSrc('openFile');
        $this->assertEquals(true, is_string($res));
        $this->assertEquals($expected, $res);
    }

    public function testGetIconSrcForIconWithSize()
    {
        $expected = '/css/msd/icons/16x16/Edit.png';
        $viewHelper = new Msd_View_Helper_GetIconSrc();
        $res = $viewHelper->getIconSrc('Edit', 16);
        $this->assertEquals(true, is_string($res));
        $this->assertEquals($expected, $res);
    }

    /**
     * @expectedException Msd_Exception
     */
    public function testFailGetNonExistantIcon()
    {
        $viewHelper = new Msd_View_Helper_GetIconSrc();
        $res = $viewHelper->getIconSrc('nonExistantIcon', 16);
    }
}

