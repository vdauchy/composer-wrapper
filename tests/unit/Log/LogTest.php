<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Log;

use Psr\Log\LoggerInterface;
use VDauchy\ComposerWrapper\Log;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;
use Mockery as m;

class LogTest extends TestCase
{
    public function testSupportLogger()
    {
        $logger = m::mock(LoggerInterface::class);
        $logger->shouldReceive('log')->with('info', 'some logs...', []);

        $log = new Log($logger);
        $log->log('info', 'some logs...');

        $this->assertSame($logger, $log->logger());
    }

    public function testExtractProblems()
    {
        $log = new Log();

        $log->logOutput('debug', "Problem 1\n");
        $log->logOutput('debug', "    This is a description of problem 1.\n");
        $log->logOutput('debug', "Problem 2\n");
        $log->logOutput('debug', "    This is a description of problem 2.\n");

        $this->assertSame([
            "This is a description of problem 1.",
            "This is a description of problem 2."
        ], $log->extractProblems());
    }

    public function testExtractFistJson()
    {
        $log = new Log();

        $log->logOutput('debug', "Do not run Composer as root/super user! See https://getcomposer.org/root for details\n");
        $log->logOutput('debug', "\n");
        $log->logOutput('debug', "{\"name\":\"init\"}\n");
        $log->logOutput('debug', "{\"name\":\"otherJson\"}\n");

        $this->assertEquals((object)[
            'name' => 'init'
        ], $log->extractFirstJson());
    }

    public function testLoggerCollector()
    {
        $log = new Log();

        $log->emergency("emergency\n");
        $log->alert("alert\n");
        $log->critical("critical\n");
        $log->error("error\n");
        $log->warning("warning\n");
        $log->notice("notice\n");
        $log->info("info\n");
        $log->debug("debug\n");
        $this->assertSame([
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
            ''
        ], $log->loggerCollector()->toArray());
    }
}
