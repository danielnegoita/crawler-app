<?php

namespace Tests;

use App\Domain\File;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\FileSystemRepository;
use App\Infrastructure\FileSystemAdaptorInterface;

class FileSystemTest extends TestCase
{
    public function testCanSavePage()
    {
        $filename = 'test.html';
        $content = '<html><body>Lorem ipsum</body></html>';
        $path = __DIR__;

        $file = new File($filename, $content, $path);

        $fakeFileSystemAdaptor = $this->createMock(FileSystemAdaptorInterface::class);
        $fakeFileSystemAdaptor->method('savePage')
            ->willReturn(true);

        $fileSystemRepository = new FileSystemRepository($fakeFileSystemAdaptor);
        $response = $fileSystemRepository->savePage($file);

        $this->assertEquals(true, $response);
    }
}