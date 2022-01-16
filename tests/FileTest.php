<?php

namespace Tests;

use App\Domain\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testCanCreatePage()
    {
        $filename = 'test.html';
        $content = 'Lorem ipsum';
        $path = __DIR__;

        $file = new File($filename, $content, $path);

        $this->assertEquals($filename, $file->filename());
        $this->assertEquals($content, $file->content());
        $this->assertEquals($path, $file->path());
    }
}