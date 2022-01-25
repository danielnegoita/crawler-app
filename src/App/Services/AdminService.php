<?php

namespace App\Services;

use App\Repository\CrawlerRepositoryInterface;
use App\Repository\IssueRepositoryInterface;
use App\Repository\LinkRepositoryInterface;

class AdminService
{
    private LinkRepositoryInterface $linkRepository;

    private CrawlerRepositoryInterface $crawlerRepository;

    private IssueRepositoryInterface $issueRepository;

    public function __construct(
        LinkRepositoryInterface $linkRepository,
        CrawlerRepositoryInterface $crawlerRepository,
        IssueRepositoryInterface $issueRepository
    ) {
        $this->linkRepository = $linkRepository;
        $this->crawlerRepository = $crawlerRepository;
        $this->issueRepository = $issueRepository;
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

    public function issues(): ?array
    {
        return $this->issueRepository->getAllIssues();
    }
}