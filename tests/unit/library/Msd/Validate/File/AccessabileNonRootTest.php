<?php
if (get_current_user() != 'root') {
    include_once(TEST_PATH . '/unit/library/Msd/Validate/File/AccessibleTest.php');
    // Exclude this test if called via cli.
    // phpunit seems to always run as user "root", no matter how we call it.
    // If we call phpunti from Jenkins (which has its own user) via Ant phpunit
    // is executed as root. If we call it from the shell as user "msd", phpunit is
    // run as root. I didn't find a way to let phpunit run as another user.
    //
    // Of course the user root can always set chmod values, so these tests
    // wouldn't make sense. To get rid of the nasty "skipped test"
    // messages if working in the shell, I only let phpunit execute these tests
    // if it is not running as root.
    // After excluding and/or blacklisting this file in phpunit.xml didn't work either
    // I am upset and simply want to get rid of this.
    // S. Bergmann, you have taken away hours of my time because things
    // doesn't work the way they are described in your documentation.
    // Better hope we will not meet again in real life. ;)
    class Msd_Validate_File_NonRootAccessibleTest extends Msd_Validate_File_AccessibleTest
    {

        public function testCanDetectIfFileIsNotReadable()
        {
            if (get_current_user() == 'root') {
                $this->markTestIncomplete('This test can not be run as user root.');
                return;
            }
            $this->chmod(0100);
            $this->validator->setOptions(array('accessTypes' => "read"));
            $this->assertEquals(false, $this->validator->isValid($this->_testFile));
        }

        public function testCanDetectIfFileIsNotWritable()
        {
            if (get_current_user() == 'root') {
                $this->markTestIncomplete('This test can not be run as user root.');
                return;
            }
            $this->chmod(0400, $this->_testFile);
            $this->validator->setOptions(array('accessTypes' => "write"));
            $this->assertEquals(false, $this->validator->isValid($this->_testFile));
        }

        public function testCanDetectIfDirIsNotReadable()
        {
            if (get_current_user() == 'root') {
                $this->markTestIncomplete('This test can not be run as user root.');
                return;
            }
            $this->chmod(0100, $this->_testDir);
            $this->validator->setOptions(array('accessTypes' => "dir,read"));
            $this->assertEquals(false, $this->validator->isValid($this->_testDir));
            $this->chmod(0700, $this->_testDir);
        }

        public function testCanDetectIfDirIsNotWritable()
        {
            if (get_current_user() == 'root') {
                $this->markTestIncomplete('This test can not be run as user root.');
                return;
            }
            $this->chmod(0400, $this->_testDir);
            $this->validator->setOptions(array('accessTypes' => "dir,write"));
            $this->assertEquals(false, $this->validator->isValid($this->_testDir));
            $this->chmod(0700, $this->_testDir);
        }
    }
}
