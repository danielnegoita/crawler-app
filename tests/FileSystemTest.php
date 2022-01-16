<?php

namespace Tests;

use App\Domain\File;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\FileSystemRepository;
use App\Infrastructure\Adapters\FlySystemAdapter;
use App\Infrastructure\FileSystemAdapterInterface;

class FileSystemTest extends TestCase
{
    public function testCanSavePage()
    {
        $filename = 'test.html';
        $content = '<html><body>Lorem ipsum</body></html>';
        $location = __DIR__;

        $file = new File($filename, $content, $location);

        $fakeFileSystemAdapter = $this->createMock(FileSystemAdapterInterface::class);
        $fakeFileSystemAdapter->method('saveFile')
            ->willReturn(true);

        $fileSystemRepository = new FileSystemRepository($fakeFileSystemAdapter);
        $response = $fileSystemRepository->saveFile($file);

        $this->assertEquals(true, $response);
    }

    public function testCanSaveFileToPath()
    {
        $filename = 'test.html';
        $content = '<html><body>Lorem ipsum</body></html>';
        $location = '/files';

        $file = new File($filename, $content, $location);

        $flySystemAdapter = new FlySystemAdapter();

        $flySystem = new FileSystemRepository($flySystemAdapter);

        $flySystem->saveFile($file);

        $this->assertFileExists(dirname(__DIR__, 1) . '/' . $file->path());
    }

    public function testCanDeleteFileInPath()
    {
        $path = 'test.html';

        $flySystemAdapter = new FlySystemAdapter();

        $flySystem = new FileSystemRepository($flySystemAdapter);

        $flySystem->deleteFile($path);

        $this->assertFileDoesNotExist(dirname(__DIR__, 1) . '/' . $path);
    }
}