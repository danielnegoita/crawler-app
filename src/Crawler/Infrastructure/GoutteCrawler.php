<?php

namespace Crawler\Infrastructure;

use Goutte\Client;
use Crawler\Domain\Url;
use Crawler\Domain\CrawlerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Crawler\Infrastructure\Exceptions\UnableToExtractHtmlFromUrl;
use Crawler\Infrastructure\Exceptions\UnableToExtractLinksFromUrl;

final class GoutteCrawler implements CrawlerInterface
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
            // Quick fix
            $externalUrl = $this->replaceInternalWithExternalHost($link->getUri());

            $pageLinks->push($externalUrl);
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
        $this->client = new Client();

        // Quick fix
        $dockerUrl = $this->replaceExternalWithInternalHost($url);

        $this->client->request('GET', $dockerUrl);

        return $this->client->getCrawler();
    }

    private function replaceExternalWithInternalHost($url)
    {
        /**
         * This only applies for internal links
         *
         * To avoid Docker error 'connection refused' on cUrl requests we need o replace
         * the container public IP with host.docker.internal @see https://stackoverflow.com/a/24326540/10532691
         *
         * This solution applies to all Docker versions newer then December 2020
         */
        return str_replace('0.0.0.0', 'host.docker.internal', $url);
    }

    private function replaceInternalWithExternalHost($url)
    {
        /**
         * This only applies for internal links
         *
         * To avoid Docker error 'connection refused' on cUrl requests we need o replace
         * the container public IP with host.docker.internal @see https://stackoverflow.com/a/24326540/10532691
         *
         * This solution applies to all Docker versions newer then December 2020
         */
        return str_replace('host.docker.internal', '0.0.0.0', $url);
    }
}