<?php

namespace Crawler\Infrastructure\Logging;

use Exception;
use Monolog\Logger;

class ExceptionLogger
{
    const CHANNEL = 'crawler';

    public static function log(?string $message, string $trace)
    {
        $logger = new Logger(self::CHANNEL);

        $logger->pushHandler(new MonologDatabaseHandler());

        $exceptionMessage = $message ?: $trace;

        $logger->error($exceptionMessage);
    }
}