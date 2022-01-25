<?php

namespace App\Repository;

use Crawler\Application\CrawlPageCommand;
use Crawler\Application\CrawlPageCommandHandler;

class CrawlerRepository implements CrawlerRepositoryInterface
{
    private CrawlPageCommandHandler $commandHandler;

    public function __construct(CrawlPageCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    public function crawl(string $url)
    {
        $command = new CrawlPageCommand($url);

        $this->commandHandler->handle($command);
    }
}