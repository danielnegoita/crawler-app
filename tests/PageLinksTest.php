<?php

namespace Tests;

use Crawler\Domain\Url;
use Crawler\Domain\Model\Link;
use PHPUnit\Framework\TestCase;

class PageLinksTest extends TestCase
{
    public function testCanCreateLink()
    {
        $pageUrl = 'http://example.com';
        $linkFromPage = Url::fromString('http://test.com');

        $link = Link::create($linkFromPage, $pageUrl);

        $this->assertEquals($pageUrl, $link->page());
        $this->assertEquals($linkFromPage, $link->link());
    }
}