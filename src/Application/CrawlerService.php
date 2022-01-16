<?php

namespace App\Application;

use App\Domain\Url;
use App\Domain\Model\Link;
use App\Domain\CrawlerInterface;
use App\Domain\Model\LinkRepositoryInterface;

class CrawlerService
{
    private CrawlerInterface $crawler;
    private LinkRepositoryInterface $linkRepository;

    public function __construct(
        CrawlerInterface $crawler,
        LinkRepositoryInterface $linkRepository
    ) {
        $this->crawler = $crawler;
        $this->linkRepository = $linkRepository;
    }

    public function saveLinksFromPage(Url $url): self
    {
        $pageLinks = $this->crawler->extractPageInternalLinks($url);

        foreach($pageLinks as $pageLink) {
            $link = Link::create(Url::fromString($pageLink), $url->toString());

            $this->linkRepository->persist($link);
        }

        $this->linkRepository->save();

        return $this;
    }
}