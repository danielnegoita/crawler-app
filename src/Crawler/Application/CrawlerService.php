<?php

namespace Crawler\Application;

use Crawler\Domain\Url;
use Crawler\Domain\File;
use Crawler\Domain\Model\Link;
use Crawler\Domain\CrawlerInterface;
use Crawler\Domain\TemplateEngineInterface;
use Crawler\Domain\FileSystemRepositoryInterface;
use Crawler\Domain\Model\LinkRepositoryInterface;

class CrawlerService
{
    private CrawlerInterface $crawler;

    private LinkRepositoryInterface $linkRepository;

    private TemplateEngineInterface $templateEngine;

    private FileSystemRepositoryInterface $fileSystemRepository;

    public function __construct(
        CrawlerInterface $crawler,
        LinkRepositoryInterface $linkRepository,
        TemplateEngineInterface $templateEngine,
        FileSystemRepositoryInterface $fileSystemRepository
    ) {
        $this->crawler = $crawler;
        $this->linkRepository = $linkRepository;
        $this->templateEngine = $templateEngine;
        $this->fileSystemRepository = $fileSystemRepository;
    }

    public function saveLinksFromPage(Url $url): self
    {
        $pageLinks = $this->crawler->extractPageInternalLinks($url);

        if(!$pageLinks) {
            return $this;
        }

        foreach($pageLinks as $pageLink) {
            $link = Link::create(Url::fromString($pageLink), $url->toString());

            $this->linkRepository->persist($link);
        }

        $this->linkRepository->save();

        return $this;
    }

    public function savePageHtmlToFile(Url $url): self
    {
        $filename = $url->toEncode() . '.html';

        $html = $this->crawler->extractHtmlFromPage($url);

        $file = new File($filename, $html, 'exports'); // TODO: move file location value to .env

        $this->fileSystemRepository->saveFile($file);

        return $this;
    }

    public function generateSitemap(Url $url): self
    {
        $pageLinks = $this->crawler->extractPageInternalLinks($url);

        //TODO: move sitemap template name to .env
        $html = $this->generateHtmlFromTemplate('sitemap-template.html.twig', $pageLinks);

        //TODO: move file location to .env (and maybe also the sitemap name)
        $file = new File('sitemap.html.twig', $html, 'templates');

        $this->fileSystemRepository->saveFile($file);

        return $this;
    }

    private function generateHtmlFromTemplate(string $template, ?array $data = []): string
    {
        return $this->templateEngine->render($template, ['links' => $data]);
    }

    public function deletePageLinks(Url $url): self
    {
        $this->linkRepository->deleteLinksByPageUrl($url->toString());

        return $this;
    }
}