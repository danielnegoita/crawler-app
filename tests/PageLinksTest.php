<?php

namespace Tests;

use App\Domain\Model\Link;
use PHPUnit\Framework\TestCase;

class PageLinksTest extends TestCase
{
    public function testCanSavePageLink()
    {
        $pageUrl = 'http://example.com';
        $pageLink = 'http://test.com';

        $link = Link::create($pageLink, $pageUrl);

        $this->assertEquals($pageUrl, $link->page());
        $this->assertEquals($pageLink, $link->link());
    }
}