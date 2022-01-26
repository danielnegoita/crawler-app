<?php

namespace Crawler\Infrastructure;

use Crawler\Domain\Url;
use Crawler\Domain\CrawlerInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;
use Crawler\Infrastructure\Exceptions\UnableToExtractHtmlFromUrl;
use Crawler\Infrastructure\Exceptions\UnableToExtractLinksFromUrl;

final class PantherCrawler implements CrawlerInterface
{
    private Client $client;

    /**
     * @param Url $url
     * @return array|null
     * @throws UnableToExtractLinksFromUrl
     */
    public function extractPageInternalLinks(Url $url): ?array
    {
        try {
            $results = $this->crawl($url->toString())->filter('body a');
        } catch (\Exception $e) {
            throw new UnableToExtractLinksFromUrl($e);
        }

        if(!$results->count()) {
            return null;
        }

        $pageLinks = collect([]);

        foreach($results->links() as $link) {
            $pageLinks->push($link->getUri());
        }

        return $pageLinks->unique()
            ->filter(function($link) use ($url) {
                return filter_var($link, FILTER_VALIDATE_URL)
                    && Url::fromString($link)->host() === $url->host()
                ;
            })
            ->toArray();
    }

    /**
     * @param Url $url
     * @return string|null
     * @throws UnableToExtractHtmlFromUrl
     */
    public function extractHtmlFromPage(Url $url): ?string
    {
        try {
            return $this->crawl($url->toString())->html();
        } catch (\Exception $e) {
            throw new UnableToExtractHtmlFromUrl($e);
        }
    }

    private function crawl(string $url): Crawler
    {
        $this->client = Client::createChromeClient(dirname(__DIR__, 3) . '/drivers/chromedriver');

        $this->client->request('GET', $url);

        return $this->client->getCrawler();
    }
}