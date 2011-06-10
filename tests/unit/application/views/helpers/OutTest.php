<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Out.php';

/**
 * @group MsdViewHelper
 */

class OutTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->view = new Zend_View();
        $helperPath = APPLICATION_PATH . DIRECTORY_SEPARATOR
            . 'views' . DIRECTORY_SEPARATOR . 'helpers';
        $this->view->addHelperPath($helperPath, 'Msd_View_Helper');
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($this->view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    public function testCanReturnOriginalValue()
    {
        $expected='test';
        $res = $this->view->out('test');
        $this->assertEquals($expected, $res);
    }
    public function testCanConvertNullValue()
    {
        $expected='NULL';
        $res = $this->view->out(null, true);
        $this->assertEquals($expected, $res);
    }

    public function testCanDecorateValue()
    {
        $expected='<i>NULL</i>';
        $res = $this->view->out(null, true, 'i');
        $this->assertEquals($expected, $res);
    }
}

