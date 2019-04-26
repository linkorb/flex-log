<?php

namespace FlexLogTest;

use PHPUnit\Framework\TestCase;
use Monolog\Registry;
use FlexLog\FlexLog;

/**
 * Class LogTest
 */
class LogTest extends TestCase
{
    public function testDefaultLoggers() {
        putenv('FLEX_LOG=' . __DIR__ . '/cascade.yaml');
        FlexLog::initFromEnv();
        FlexLog::ensureLoggers(['user', 'security', 'db']);
        $this->assertTrue(Registry::hasLogger('app'), 'Default logger exists');
        $this->assertTrue(Registry::hasLogger('caching'), 'Config file logger exists');
        $this->assertFalse(Registry::hasLogger('some_unspecified_logger'), 'Undefined logger exists?');

        Registry::app()->info("Example app log, {greeting}!", ['greeting' => 'hello']);
        // Registry::caching()->info("Example caching log");
    }
}