<?php

namespace Tests;

use Crawler\Domain\Url;
use Crawler\Infrastructure\PantherCrawler;
use PHPUnit\Framework\TestCase;

class PantherCrawlerTest extends TestCase
{
    // TODO: refactor this test to crawl a local page for better control
    // TODO: write a test for when there are no internal links on the page
    public function testCanExtractInternalPageLinks()
    {
        $panther = new PantherCrawler();

        $url = Url::fromString('https://api-platform.com/');

        $pageLinks = $panther->extractPageInternalLinks($url);

        $this->assertGreaterThan(0, count($pageLinks));
    }

    public function testCanExtractHtmlFromPageProvidingAUrl()
    {
        $url = Url::fromString('http://example.com/');

        $panther = new PantherCrawler();

        $html = $panther->extractHtmlFromPage($url);

        $this->assertMatchesRegularExpression('/<\/?[a-z][\s\S]*>/i', $html);
    }
}