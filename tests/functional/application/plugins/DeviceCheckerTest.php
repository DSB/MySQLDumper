<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once APPLICATION_PATH . '/plugins/DeviceCheck.php';
//'DeviceCheck.php';
/**
 * @group MsdPlugins
 */
 
class DeviceCheckerTest extends ControllerTestCase
{

    protected $_deviceChecker = null;
    protected $_ZendLayout = null;

    public function setUp()
    {
        $this->_deviceChecker = new Application_Plugin_DeviceCheck();
        $this->_ZendLayout = Zend_Layout::getMvcInstance();
    }

    public function testDispatchLoopStartupIsMobile()
    {
        $userAgentString = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like
                            Mac OS X; en-us) AppleWebKit/528.18
                            (KHTML, like Gecko) Version/4.0 Mobile/7A341
                            Safari/528.16';

        //Mock http_user_agent
        $request = $this->getRequest()
                    ->setHeader('user-agent', $userAgentString);

        $this->_deviceChecker->dispatchLoopStartup($request);
        $layout = $this->_ZendLayout->getLayout();
        $expectedLayout = 'mobile';
        $this->assertSame($layout, $expectedLayout);

    }
}
