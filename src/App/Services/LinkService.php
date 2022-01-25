<?php

namespace App\Services;

use App\Repository\CrawlerRepositoryInterface;
use App\Repository\LinkRepositoryInterface;

class LinkService
{
    private LinkRepositoryInterface $linkRepository;

    private CrawlerRepositoryInterface $crawlerRepository;

    public function __construct(LinkRepositoryInterface $linkRepository, CrawlerRepositoryInterface $crawlerRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->crawlerRepository = $crawlerRepository;
    }

    public function crawl(string $url): ?array
    {
        $this->crawlerRepository->crawl($url);

        return $this->internalLinks($url);
    }

    public function internalLinks(string $url): ?array
    {
        return $this->linkRepository->getInternalLinks($url);
    }
}