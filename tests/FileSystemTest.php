<?php

namespace Tests;

use App\Domain\File;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\FileSystemRepository;
use App\Infrastructure\FileSystemAdapterInterface;

class FileSystemTest extends TestCase
{
    public function testCanSavePage()
    {
        $filename = 'test.html';
        $content = '<html><body>Lorem ipsum</body></html>';
        $path = __DIR__;

        $file = new File($filename, $content, $path);

        $fakeFileSystemAdapter = $this->createMock(FileSystemAdapterInterface::class);
        $fakeFileSystemAdapter->method('savePage')
            ->willReturn(true);

        $fileSystemRepository = new FileSystemRepository($fakeFileSystemAdapter);
        $response = $fileSystemRepository->savePage($file);

        $this->assertEquals(true, $response);
    }
}