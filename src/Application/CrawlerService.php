<?php

namespace App\Application;

use App\Domain\Url;
use App\Domain\File;
use App\Domain\Model\Link;
use App\Domain\CrawlerInterface;
use App\Domain\FileSystemRepositoryInterface;
use App\Domain\Model\LinkRepositoryInterface;

class CrawlerService
{
    private CrawlerInterface $crawler;

    private LinkRepositoryInterface $linkRepository;

    private FileSystemRepositoryInterface $fileSystemRepository;

    public function __construct(
        CrawlerInterface $crawler,
        LinkRepositoryInterface $linkRepository,
        FileSystemRepositoryInterface $fileSystemRepository
    ) {
        $this->crawler = $crawler;
        $this->linkRepository = $linkRepository;
        $this->fileSystemRepository = $fileSystemRepository;
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

    public function savePageHtmlToFile(Url $url)
    {
        $filename = $url->toEncode() . '.html';

        $html = $this->crawler->extractHtmlFromPage($url);

        $file = new File($filename, $html, 'files'); // TODO: move file location value to .env

        $this->fileSystemRepository->saveFile($file);

        return $this;
    }
}