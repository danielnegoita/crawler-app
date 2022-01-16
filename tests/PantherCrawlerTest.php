<?php

namespace Tests;

use App\Domain\Url;
use App\Infrastructure\PantherCrawler;
use PHPUnit\Framework\TestCase;

class PantherCrawlerTest extends TestCase
{
    //TODO: refactor this to crawl a local page so we assert something more relevant
    public function testCanExtractInternalPageLinks()
    {
        $panther = new PantherCrawler();

        $url = Url::fromString('https://api-platform.com');

        $pageLinks = $panther->extractPageInternalLinks($url);

        $this->assertTrue(count($pageLinks) > 0);
    }
}