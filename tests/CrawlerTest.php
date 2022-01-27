<?php

namespace Tests;

use Crawler\Domain\Url;
use Crawler\Infrastructure\GoutteCrawler;
use PHPUnit\Framework\TestCase;

class CrawlerTest extends TestCase
{
    // TODO: refactor to use an interface instead of a concreate class
    // TODO: refactor this test to crawl a local page for better control
    // TODO: write a test for when there are no internal links on the page
    public function testCanExtractInternalPageLinks()
    {
        $crawler = new GoutteCrawler();

        $url = Url::fromString('https://api-platform.com/');

        $pageLinks = $crawler->extractPageInternalLinks($url);

        $this->assertGreaterThan(0, count($pageLinks));
    }

    public function testCanExtractHtmlFromPageProvidingAUrl()
    {
        $url = Url::fromString('http://example.com/');

        $crawler = new GoutteCrawler();

        $html = $crawler->extractHtmlFromPage($url);

        $this->assertMatchesRegularExpression('/<\/?[a-z][\s\S]*>/i', $html);
    }
}