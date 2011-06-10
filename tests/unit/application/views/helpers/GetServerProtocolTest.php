<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'GetServerProtocol.php';

/**
 * @group MsdViewHelper
 */
class GetServerProtocolTest extends PHPUnit_Framework_TestCase
{
    public function testGetServerProtocolHTTP()
    {
        $expected='http://';
        $_SERVER['HTTPS'] = 'Off';
        $viewHelper = new Msd_View_Helper_GetServerProtocol();
        $res = $viewHelper->getServerProtocol();
        $this->assertEquals($expected, $res);
    }

    public function testGetServerProtocolHTTPS()
    {
        $expected='https://';
        $_SERVER['HTTPS'] = 'On';
        $viewHelper = new Msd_View_Helper_GetServerProtocol();
        $res = $viewHelper->getServerProtocol();
        $this->assertEquals($expected, $res);
    }

}

