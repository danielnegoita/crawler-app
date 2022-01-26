<?php

namespace Crawler\Application;

use Crawler\Domain\Url;

class CrawlPageCommandHandler
{
    private CrawlerService $crawlerService;

    public function __construct(CrawlerService $crawlerService)
    {
        $this->crawlerService = $crawlerService;
    }

    /**
     * @param CrawlPageCommand $command
     * @throws \Crawler\Domain\InvalidUrlException
     */
    public function handle(CrawlPageCommand $command)
    {
        $url = Url::fromString($command->getUrl());

        $this->crawlerService
            ->deletePageLinks($url)
            ->saveLinksFromPage($url)
            ->savePageHtmlToFile($url)
            ->generateSitemap($url);
    }
}