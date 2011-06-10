<?php
/**
 * @group validate
 */
class Msd_Validate_File_AccessibleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string Path to test files
     */
    protected $_testFile = '';

    /**
     * @var string Path to test files
     */
    protected $_testDir = '';

    /**
     * @var Msd_Validate_File_Accessible
     */
    protected $validator = null;

    public function setUp()
    {
        parent::setUp();
        $this->_testDir = TEST_PATH . DS . 'fixtures' . DS . 'tmp';
        if (!file_exists($this->_testDir)) {
            mkdir($this->_testDir, 0777);
            $this->chmod(0777, $this->_testDir);
        }
        $this->_testFile = $this->_testDir . '/testFile.sh';
        if (!file_exists($this->_testFile)) {
            file_put_contents($this->_testFile, "#!/bin/sh\necho 'Executed'\n");
            $this->chmod(0777);
        }
        $this->validator = new Msd_Validate_File_Accessible();
    }

    /**
     * Chmod _testFile to given value
     *
     * @param string $rights Octal rights
     * @param bool   $file   FileName
     * @return void
     */
    public function chmod($rights, $file = false)
    {
        if ($file === false) {
            $file = $this->_testFile;
        }
        $chmod = chmod($file, $rights);
        clearstatcache();
        if ($chmod === false) {
            $this->fail('Couldn\'t chmod ' . $file . ' to ' . $rights);
        }
    }

    public function testCanDetectIfFileExists()
    {
        $this->chmod(0400);
        $this->assertEquals(true, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileDoesNotExists()
    {
        $file = $this->_testDir . '/IDontExist.txt';
        $this->assertEquals(false, $this->validator->isValid($file));
    }

    public function testCanDetectIfFileIsReadable()
    {
        $this->chmod(0400);
        $this->validator->setOptions(array('accessTypes' => "read"));
        $this->assertEquals(true, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileIsWritable()
    {
        $this->chmod(0200);
        $this->validator->setOptions(array('accessTypes' => "write"));
        $this->assertEquals(true, $this->validator->isValid($this->_testFile));
    }


    public function testCanDetectIfFileIsExecutable()
    {
        $this->chmod(0100);
        $this->validator->setOptions(array('accessTypes' => "execute"));
        $this->assertEquals(true, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileIsNotExecutable()
    {
        $this->chmod(0400);
        $this->validator->setOptions(array('accessTypes' => "execute"));
        $this->assertEquals(false, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileIsDir()
    {
        $this->chmod(0777, $this->_testDir);
        $this->validator->setOptions(array('accessTypes' => "dir"));
        $this->assertEquals(true, $this->validator->isValid($this->_testDir));
    }

    public function testCanDetectIfFileIsNotDir()
    {
        $this->validator->setOptions(array('accessTypes' => "dir"));
        $this->assertEquals(false, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileIsFile()
    {
        $this->chmod(0700);
        $this->validator->setOptions(array('accessTypes' => "file"));
        $this->assertEquals(true, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfFileIsNotAFile()
    {
        $this->chmod(0700, $this->_testDir);
        $this->validator->setOptions(array('accessTypes' => "file"));
        $this->assertEquals(false, $this->validator->isValid($this->_testDir));
    }

    public function testCanDetectIfFileIsNotUploaded()
    {
        $this->chmod(0700);
        $this->validator->setOptions(array('accessTypes' => "uploaded"));
        $this->assertEquals(false, $this->validator->isValid($this->_testFile));
    }

    public function testCanDetectIfDirIsReadable()
    {
        $this->chmod(0400, $this->_testDir);
        $this->validator->setOptions(array('accessTypes' => "dir,read"));
        $this->assertEquals(true, $this->validator->isValid($this->_testDir));
        $this->chmod(0700, $this->_testDir);
    }

    public function testCanDetectIfDirIsWritable()
    {
        $this->chmod(0200, $this->_testDir);
        $this->validator->setOptions(array('accessTypes' => "dir,write"));
        $this->assertEquals(true, $this->validator->isValid($this->_testDir));
        $this->chmod(0700, $this->_testDir);
    }

    public function testCanSetOptionsWithAccessTypesAsString()
    {
        $this->validator->setOptions(
            array(
                 'pathPrefix' => './',
                 'accessTypes' => 'read,write'
            )
        );

        $options = $this->validator->getOptions();
        $this->assertInternalType('array', $options);
        $this->assertArrayHasKey('pathPrefix', $options);
        $this->assertEquals('./', $options['pathPrefix']);
        $this->assertInternalType('array', $options['accessTypes']);
        $this->assertTrue($options['accessTypes']['read']);
        $this->assertTrue($options['accessTypes']['write']);
    }

    public function testCanSetOptionsWithAccessTypesAsZendConfig()
    {
        $this->validator->setOptions(
            array(
                 'pathPrefix' => './',
                 'accessTypes' => new Zend_Config(array('read', 'write')),
            )
        );

        $options = $this->validator->getOptions();
        $this->assertInternalType('array', $options);
        $this->assertArrayHasKey('pathPrefix', $options);
        $this->assertEquals('./', $options['pathPrefix']);
        $this->assertInternalType('array', $options['accessTypes']);
        $this->assertTrue($options['accessTypes']['read']);
        $this->assertTrue($options['accessTypes']['write']);
    }

    public function testCanSetOptionsWithAccessTypesAsArray()
    {
        $this->validator->setOptions(
            array(
                 'pathPrefix' => './',
                 'accessTypes' => array('read', 'write'),
            )
        );

        $options = $this->validator->getOptions();
        $this->assertInternalType('array', $options);
        $this->assertArrayHasKey('pathPrefix', $options);
        $this->assertEquals('./', $options['pathPrefix']);
        $this->assertInternalType('array', $options['accessTypes']);
        $this->assertTrue($options['accessTypes']['read']);
        $this->assertTrue($options['accessTypes']['write']);
    }

    public function testClassConstructorSetsOptions()
    {
        $validator = new Msd_Validate_File_Accessible(
            array(
                 'pathPrefix' => './',
                 'accessTypes' => array('read', 'write'),
            )
        );

        $options = $validator->getOptions();
        $this->assertInternalType('array', $options);
        $this->assertArrayHasKey('pathPrefix', $options);
        $this->assertEquals('./', $options['pathPrefix']);
        $this->assertInternalType('array', $options['accessTypes']);
        $this->assertTrue($options['accessTypes']['read']);
        $this->assertTrue($options['accessTypes']['write']);
    }

    /**
     * @expectedException Msd_Validate_Exception
     */
    public function testThrowsExceptionIfOptionsArgumentIsNotAnArray()
    {
        $this->validator->setOptions('Go test and throw the exception.');
    }

    /**
     * @expectedException Msd_Validate_Exception
     */
    public function testThrowsExceptionIfAccessTypesOptionIsAnInvalidVariableType()
    {
        $this->validator->setOptions(array('accessTypes' => new stdClass()));
    }

}