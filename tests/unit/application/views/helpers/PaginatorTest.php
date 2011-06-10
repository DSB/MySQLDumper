<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Paginator.php';

/**
 * @group MsdViewHelper
 */
class PaginatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_View
     */
    public $view = null;
    
    public function setUp()
    {
        $this->view = new Zend_View();
        $helperPath = implode(DIRECTORY_SEPARATOR, array(APPLICATION_PATH, 'views', 'helpers'));
        $scriptPath = implode(DIRECTORY_SEPARATOR, array(APPLICATION_PATH, 'views', 'scripts'));
        $this->view->addHelperPath($helperPath, 'Msd_View_Helper');
        $this->view->setScriptPath($scriptPath);
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($this->view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    public function testOnChangeReturnsValidJavascriptCode()
    {
        $paginator = new Msd_View_Helper_Paginator();
        $reflection = new ReflectionClass($paginator);
        $method = $reflection->getMethod('_getOnChange');
        $method->setAccessible(true);

        $onChange = $method->invokeArgs($paginator, array('form'));
        $this->assertEquals('$(this).parent().parent()[0].submit();', $onChange);

        $onChange = $method->invokeArgs($paginator, array('url', '/sql/index/', 'pageNumber'));
        $this->assertEquals("window.location.href = '/sql/index/pageNumber/' + this.value + '/';", $onChange);

        $onChange = $method->invokeArgs($paginator, array('js', 'changePage(this.value);'));
        $this->assertEquals('changePage(this.value);', $onChange);
    }

    public function testGetButtonClickReturnsValidJavascriptCode()
    {
        $paginator = new Msd_View_Helper_Paginator();
        $reflection = new ReflectionClass($paginator);
        $method = $reflection->getMethod('_getButtonClick');
        $method->setAccessible(true);

        $onChange = $method->invokeArgs(
            $paginator,
            array(
                 'form',
                 array('targetPage' => 2)
            )
        );
        $this->assertEquals("$(this).parent().children('select').val(2); $(this).parent().parent()[0].submit();", $onChange);

        $onChange = $method->invokeArgs(
            $paginator,
            array(
                 'url',
                 array('baseUrl' => '/sql/index/', 'urlParam' => 'pageNumber', 'targetPage' => 2)
            )
        );
        $this->assertEquals("window.location.href = '/sql/index/pageNumber/2/';", $onChange);

        $onChange = $method->invokeArgs(
            $paginator,
            array(
                 'js',
                 array('targetPage' => 2, 'onClick' => 'PHPUnitTest(:PAGE:);')
            )
        );
        $this->assertEquals('PHPUnitTest(2);', $onChange);
    }

    public function testGetButtonInfoReturnsInformationForTheButtonState()
    {
        $paginator = new Msd_View_Helper_Paginator();
        $reflection = new ReflectionClass($paginator);
        $method = $reflection->getMethod('_getButtonInfo');
        $method->setAccessible(true);

        $buttonInfo = $method->invoke($paginator, false);
        $this->assertArrayHasKey('icon', $buttonInfo);
        $this->assertEmpty($buttonInfo['icon']);
        $this->assertArrayHasKey('disabled', $buttonInfo);
        $this->assertEmpty($buttonInfo['disabled']);

        $buttonInfo = $method->invoke($paginator, true);
        $this->assertArrayHasKey('icon', $buttonInfo);
        $this->assertEquals('Disabled', $buttonInfo['icon']);
        $this->assertArrayHasKey('disabled', $buttonInfo);
        $this->assertEquals(' disabled="disabled"', $buttonInfo['disabled']);
    }

    public function testCanBuildAPaginatorWhichUsesJavascriptForPageSwitch()
    {
        $options = array(
            'currentPage' => 1,
            'pageCount' => 10,
            'urlParam' => 'pageNr',
            'baseUrl' => '/php/unit/test/',
            'mode' => 'js',
            'actions' => array(
                'first' => 'first(:PAGE:);',
                'prev' => 'prev(:PAGE:);',
                'next' => 'next(:PAGE:);',
                'last' => 'last(:PAGE:);',
                'change' => 'change(this.value);',
            ),
        );
        $paginator = new Msd_View_Helper_Paginator();
        $paginator->setView($this->view);
        $result = $paginator->paginator($options);

        $button = strpos($result, '<button class="Formbutton first" type="button" onclick="first(1);" accesskey="c" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton paginator prev" type="button" onclick="prev(0);" accesskey="v" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<select id="combobox" name="pageNr" onchange="change(this.value);" accesskey="b">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton next" type="button" onclick="next(2);" accesskey="n">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton last" type="button" onclick="last(10);" accesskey="m">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '$("#combobox").combobox();');
        $this->assertNotEquals(false, $button);
    }

    public function testCanBuildAPaginatorWhichUsesFormForPageSwitch()
    {
        $options = array(
            'currentPage' => 1,
            'pageCount' => 10,
            'urlParam' => 'pageNr',
            'baseUrl' => '/php/unit/test/',
            'mode' => 'form',
        );

        $paginator = new Msd_View_Helper_Paginator();
        $paginator->setView($this->view);
        $result = $paginator->paginator($options);
        
        $button = strpos($result, '<button class="Formbutton first" type="submit" onclick="$(this).parent().children(\'select\').val(1); $(this).parent().parent()[0].submit();" accesskey="c" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton paginator prev" type="submit" onclick="$(this).parent().children(\'select\').val(0); $(this).parent().parent()[0].submit();" accesskey="v" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<select id="combobox" name="pageNr" onchange="$(this).parent().parent()[0].submit();" accesskey="b">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton next" type="submit" onclick="$(this).parent().children(\'select\').val(2); $(this).parent().parent()[0].submit();" accesskey="n">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton last" type="submit" onclick="$(this).parent().children(\'select\').val(10); $(this).parent().parent()[0].submit();" accesskey="m">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '$("#combobox").combobox();');
        $this->assertNotEquals(false, $button);
    }

    public function testCanBuildAPaginatorWhichUsesUrlsForPageSwitch()
    {
        $options = array(
            'currentPage' => 1,
            'pageCount' => 10,
            'urlParam' => 'pageNr',
            'baseUrl' => '/php/unit/test/',
            'mode' => 'url',
        );

        $paginator = new Msd_View_Helper_Paginator();
        $paginator->setView($this->view);
        $result = $paginator->paginator($options);

        $button = strpos($result, '<button class="Formbutton first" type="button" onclick="window.location.href = \'/php/unit/test/pageNr/1/\';" accesskey="c" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton paginator prev" type="button" onclick="window.location.href = \'/php/unit/test/pageNr/0/\';" accesskey="v" disabled="disabled">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<select id="combobox" name="pageNr" onchange="window.location.href = \'/php/unit/test/pageNr/\' + this.value + \'/\';" accesskey="b">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton next" type="button" onclick="window.location.href = \'/php/unit/test/pageNr/2/\';" accesskey="n">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '<button class="Formbutton last" type="button" onclick="window.location.href = \'/php/unit/test/pageNr/10/\';" accesskey="m">');
        $this->assertNotEquals(false, $button);

        $button = strpos($result, '$("#combobox").combobox();');
        $this->assertNotEquals(false, $button);
    }
}
