<?php

namespace Tests;

use Crawler\Domain\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testCanCreatePage()
    {
        $filename = 'test.html';
        $content = 'Lorem ipsum';
        $location = __DIR__;

        $file = new File($filename, $content, $location);

        $this->assertEquals($filename, $file->filename());
        $this->assertEquals($content, $file->content());
        $this->assertEquals($location, $file->location());
    }
}