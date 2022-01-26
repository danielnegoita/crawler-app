<?php

namespace Crawler\Infrastructure\Exceptions;

use Throwable;
use Crawler\Infrastructure\Logging\ExceptionLogger;

class BaseException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        ExceptionLogger::log($message, $this->getTraceAsString());

        parent::__construct($message, $code, $previous);
    }
}