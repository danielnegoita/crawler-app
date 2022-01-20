<?php

namespace Tests;

use Crawler\Domain\Url;
use Crawler\Domain\Model\Link;
use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase
{
    public function testCanCreateLink()
    {
        $page = 'http://example.com';
        $pageLink = 'http://test.com';

        $link = Link::create(Url::fromString($pageLink), $page);

        $this->assertEquals($page, $link->page());
        $this->assertEquals($pageLink, $link->link()->toString());
    }

    public function testCanReturnLinkAsArray()
    {
        $linkArray = [
            'page' => 'http://example.com',
            'link' => 'http://test.com'
        ];

        $link = Link::create(
            Url::fromString($linkArray['link']),
            $linkArray['page']
        );

        $this->assertEquals($linkArray, $link->toArray());
    }
}
