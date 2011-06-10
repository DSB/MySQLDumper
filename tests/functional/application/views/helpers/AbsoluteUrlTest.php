<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'AbsoluteUrl.php';

/**
 * @group MsdViewHelper
 */
class AbsoluteUrlTest extends ControllerTestCase
{
    public function testCanGetAbsoluteUrl()
    {
        $_SERVER['HTTP_SCHEME'] = 'http';
        $_SERVER['SERVER_PORT'] = 80;

        $this->loginUser();
        $viewHelper = new Msd_View_Helper_AbsoluteUrl();

        $options = array('controller'=>'sql','action'=>'show.databases');
        $res = $viewHelper->absoluteUrl($options);
        $expected = 'http://localhost/sql/show.databases';
        $this->assertEquals($expected, $res);
    }

}
