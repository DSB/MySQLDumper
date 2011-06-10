<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Filesize.php';

/**
 * @group MsdViewHelper
 */
class FilesizeTest extends PHPUnit_Framework_TestCase
{
    public function testFilesize()
    {
        $expected='14.00 <span class="explain tooltip" title="Bytes">B</span>';
        //setup view and helper path to Msd_View_Helper
        // needed because the filesize-helper calls the byteOupt-Helper
        $view = new Zend_View();
        $helperPath = APPLICATION_PATH . DIRECTORY_SEPARATOR
            . 'views' . DIRECTORY_SEPARATOR . 'helpers';
        $view->addHelperPath($helperPath, 'Msd_View_Helper');
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        $res = $view->filesize(
            APPLICATION_PATH . '/.htaccess'
        );
        $this->assertEquals($expected, $res);
    }
}

