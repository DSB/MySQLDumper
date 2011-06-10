<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'GetFreeDiskspace.php';

/**
 * @group MsdViewHelper
 */
class GetFreeDiskspaceTest extends ControllerTestCase
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

    public function testGetFreeDiskspace()
    {
        $ret = $this->view->getFreeDiskspace();
        $res = strpos($ret, '<span class="explain tooltip"')!== false ? true:false;
        $this->assertEquals(true, $res);
    }

}

