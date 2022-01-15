<?php

namespace Tests;

use App\Domain\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testCanCreatePage()
    {
        $url = 'http://test.com';
        $encode = urlencode('http://test.com');

        $urlObject = Url::fromString($url);

        $this->assertEquals($url, $urlObject->toString());
        $this->assertEquals($encode, $urlObject->toEncode());
    }
}