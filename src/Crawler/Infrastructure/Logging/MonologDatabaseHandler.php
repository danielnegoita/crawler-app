<?php

namespace Crawler\Infrastructure\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Crawler\Infrastructure\Adapters\MySqlAdapter;

class MonologDatabaseHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     */
    protected function write(array $record): void
    {
        $mySqlStorage = new MySqlAdapter();

        $mySqlStorage->saveIssue($record);
    }
}