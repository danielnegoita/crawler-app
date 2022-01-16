<?php

namespace Tests;

use App\Domain\File;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\FileSystemRepository;
use App\Infrastructure\Adapters\FlySystemAdapter;

class FileSystemTest extends TestCase
{
    public function testCanSaveFileToPath()
    {
        $filename = 'test.html';
        $content = '<html><body>Lorem ipsum</body></html>';

        $file = new File($filename, $content);

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