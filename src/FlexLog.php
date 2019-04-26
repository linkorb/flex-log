<?php

namespace FlexLog;

use Cascade\Cascade;
use Monolog\Registry;
use Monolog\Logger;
use RuntimeException;

class FlexLog
{
    /**
     * Initialize monolog with cascade, based on the `FLEX_LOG` env variable, if specified
     */
    public static function initFromEnv()
    {
        $filename = getenv('FLEX_LOG');
        if (!$filename) {
            return; // Logging unconfigured
        }
       
        if (!file_exists($filename)) {
            throw new RuntimeException("FLEX_LOG file not found: " . $filename);
        }
        Cascade::fileConfig($filename);
    }

    /**
     * Ensure that provided logger names exist in the monolog registry
     */
    public static function ensureLoggers(array $loggerNames)
    {
        foreach ($loggerNames as $loggerName) {
            if (!Registry::hasLogger($loggerName)) {
                $logger = new Logger($loggerName);
                Registry::addLogger($logger);
            }
        }
    }
}