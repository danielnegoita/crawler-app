<?php

namespace App\Infrastructure;

use App\Domain\File;
use App\Domain\FileSystemRepositoryInterface;

class FileSystemRepository implements FileSystemRepositoryInterface
{
    private FileSystemAdapterInterface $fileSystemAdaptor;

    public function __construct(FileSystemAdapterInterface $fileSystemAdaptor)
    {
        $this->fileSystemAdaptor = $fileSystemAdaptor;
    }

    public function savePage(File $file): bool
    {
        return $this->fileSystemAdaptor->savePage($file);
    }
}