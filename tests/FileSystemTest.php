<?php

namespace Tests;


use PHPUnit\Framework\TestCase;
use App\Infrastructure\FileSystemAdaptorInterface;
use App\Infrastructure\FileSystemRepository;

class FileSystemTest extends TestCase
{
    public function testCanSavePage()
    {
        $html = '<html><body>Test</body></html>';
        $name = 'testFile';
        $path = __DIR__;

        $fakeFileSystemAdaptor = $this->createMock(FileSystemAdaptorInterface::class);
        $fakeFileSystemAdaptor->method('savePage')
            ->willReturn(true);

        $fileSystemRepository = new FileSystemRepository($fakeFileSystemAdaptor);
        $response = $fileSystemRepository->savePage($html, $name, $path);

        $this->assertEquals(true, $response);
    }
}