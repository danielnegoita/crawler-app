<?php

namespace App\Infrastructure;

use App\Domain\File;
use App\Domain\FileSystemRepositoryInterface;

class FileSystemRepository implements FileSystemRepositoryInterface
{
    private FileSystemAdaptorInterface $fileSystemAdaptor;

    public function __construct(FileSystemAdaptorInterface $fileSystemAdaptor)
    {
        $this->fileSystemAdaptor = $fileSystemAdaptor;
    }

    public function savePage(File $file): bool
    {
        return $this->fileSystemAdaptor->savePage($file);
    }
}