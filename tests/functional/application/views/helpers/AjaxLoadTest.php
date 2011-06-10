<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'AjaxLoad.php';

/**
 * @group MsdViewHelper
 */
class AjaxLoadTest extends ControllerTestCase
{
    public function testCanGetAbsoluteUrl()
    {
        $this->loginUser();
        $viewHelper = new Msd_View_Helper_AjaxLoad();

        $ajaxOptions = array('controller' => 'sql', 'action' => 'phpinfo');
        $viewOptions = array(
                        'loadingMessage' => 'loading...',
                        'showThrober' => true
                   );
        $res = $viewHelper->ajaxLoad($ajaxOptions, $viewOptions);
        $this->assertTrue(is_string($res));
        $checks = array(
                        '<span id="ajax-', // do we have our span?
                        'url: \'/sql/phpinfo', // did we get the correct Url?
                        'loading..', // loading message is in there?
        );
        foreach ($checks as $check) {
            $this->assertTrue(strpos($res, $check) !== false,
                'Not found in response: '.$check
            );
        }
    }

}
