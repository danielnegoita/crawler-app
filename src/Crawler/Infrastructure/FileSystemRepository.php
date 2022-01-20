<?php

namespace Crawler\Infrastructure;

use Crawler\Domain\File;
use Crawler\Domain\FileSystemRepositoryInterface;

class FileSystemRepository implements FileSystemRepositoryInterface
{
    private FileSystemAdapterInterface $fileSystemAdaptor;

    public function __construct(FileSystemAdapterInterface $fileSystemAdaptor)
    {
        $this->fileSystemAdaptor = $fileSystemAdaptor;
    }

    public function saveFile(File $file): void
    {
        $this->fileSystemAdaptor->saveFile($file);
    }

    public function deleteFile(string $path): void
    {
        $this->fileSystemAdaptor->deleteFile($path);
    }
}