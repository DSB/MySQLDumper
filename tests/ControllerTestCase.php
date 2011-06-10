<?php
require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';

class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * @var Zend_Application
     */
    protected $_application;

    public function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
        $_SERVER['SERVER_NAME'] = 'localhost';
    }

    public function appBootstrap()
    {
        $this->_application= new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );
        $this->_application->bootstrap();
    }

    public function tearDown()
    {
        $this->resetRequest();
        $this->resetResponse();
        parent::tearDown();
    }

    public function loginUser($userName = 'tester', $userPass = 'test')
    {
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'user' => $userName,
                        'pass' => $userPass,
                        'autologin' => 0
                  )
              );
        $this->dispatch('/index/login');
        // after successful login we should be redirected to the index page
        $this->assertResponseCode('302');
        $this->assertRedirectTo('/');
        // clear request - so each test can use it's own dispatch
        $this->clearRequest();
    }

    public function clearRequest()
    {
        // clear the request for further testing
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->request->setMethod('GET');
    }

    // You like to debug non working tests without useful messages?
    // Here you go. ;)
    public function showResponse()
    {
        $response = $this->getResponse();
        echo "\n\nStatus Code: " . $response->getHttpResponseCode() . "\n\n";
        foreach ($response->getHeaders() as $header) {
            $replace = 'false';
            if ($header['replace'] === true) {
                $replace = 'true';
            }
            echo "\t {$header['name']} - {$header['value']} "
                ."(replace: {$replace})\n";
        }
        if ($response->isException()) {
            echo "Exceptions:\n\n";
            foreach ($response->getException() as $exception) {
                echo "\t * Message: {$exception->getMessage()}\n";
                echo "\t * File:    {$exception->getFile()}\n";
                echo "\t * Line:    {$exception->getLine()}\n";
                echo "\n";
            }
        }
        $body = $response->getBody();
        if ($body > '') {
            echo str_repeat('-', 80) . "\n" . $body. str_repeat('-', 80);
        }
        // force output
        die();
    }

    /**
     * Read a fixture file from directory "tests/fixtures" and return content as string.
     *
     * @param string $fileName The filename to read
     *
     * @return string
     */
    public function loadFixtureFile($fileName)
    {
        $fixturePath = realpath(dirname(__FILE__) . DS . 'fixtures');
        $fullFileName = $fixturePath . DS . $fileName;
        $content = file_get_contents($fullFileName);
        return $content;
    }
}