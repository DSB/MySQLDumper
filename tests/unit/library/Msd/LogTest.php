<?php
/**
 * @group Log
 */
class Msd_LogTest extends PHPUnit_Framework_TestCase
{
    public function testCanGetLogger()
    {
        $logger = new Msd_Log();
        $this->assertInstanceof('Msd_Log', $logger);
    }

    public function testCanGetFilePathOfLoggerType()
    {
        $logger = new Msd_Log();
        $this->assertInstanceof('Msd_Log', $logger);

        $logPath = $logger->getFile(Msd_Log::PHP);
        $this->assertEquals(WORK_PATH . '/log/php.log', $logPath);

        $logPath = $logger->getFile(Msd_Log::PERL);
        $this->assertEquals(WORK_PATH . '/log/perl.log', $logPath);

        $logPath = $logger->getFile(Msd_Log::PERL_COMPLETE);
        $this->assertEquals(WORK_PATH . '/log/perlComplete.log', $logPath);

        $logPath = $logger->getFile(Msd_Log::ERROR);
        $this->assertEquals(WORK_PATH . '/log/phpError.log', $logPath);
    }

    public function testCanGetLoggerOfGivenType()
    {
        $logger = new Msd_Log();
        $this->assertInstanceof('Msd_Log', $logger);
        $loggerTypes = array(
                        Msd_Log::PHP => WORK_PATH . '/log/php.log',
                        Msd_Log::PERL => WORK_PATH . '/log/perl.log',
                        Msd_Log::PERL_COMPLETE => WORK_PATH . '/log/perlComplete.log',
                        Msd_Log::ERROR => WORK_PATH . '/log/phpError.log',
                  );
        foreach ($loggerTypes as $logType => $logPath) {
            $this->assertInstanceof('Zend_Log', $logger->getLogInstance($logType));
            $this->assertEquals($logger->getFile($logType), $logPath);
        }
    }


    public function testClosesFileHandlesOnDestroy()
    {
        $logger = new Msd_Log();
        $this->assertInstanceof('Msd_Log', $logger);
        $loggerTypes = array(
                        Msd_Log::PHP => WORK_PATH . '/log/php.log',
                        Msd_Log::PERL => WORK_PATH . '/log/perl.log',
                        Msd_Log::PERL_COMPLETE => WORK_PATH . '/log/perlComplete.log',
                        Msd_Log::ERROR => WORK_PATH . '/log/phpError.log',
                  );
        foreach ($loggerTypes as $logType => $logPath) {
            $this->assertInstanceof('Zend_Log', $logger->getLogInstance($logType));
            $this->assertEquals($logger->getFile($logType), $logPath);
        }
        unset($logger);
    }
}