<?php

namespace App\Infrastructure;

use App\Domain\Url;
use App\Domain\CrawlerInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;

final class PantherCrawler implements CrawlerInterface
{
    private Client $client;

    public function extractPageInternalLinks(Url $url): ?array
    {
        $results = $this->crawl($url->toString())->filter('body a');

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

    public function extractHtmlFromPage(Url $url): ?string
    {
        return $this->crawl($url->toString())->html();
    }

    private function crawl(string $url): Crawler
    {
        $this->client = Client::createChromeClient();

        $this->client->request('GET', $url);

        return $this->client->getCrawler();
    }
}