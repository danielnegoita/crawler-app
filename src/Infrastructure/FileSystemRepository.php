<?php

namespace App\Infrastructure;

use App\Domain\FileSystemRepositoryInterface;

class FileSystemRepository implements FileSystemRepositoryInterface
{
    private FileSystemAdaptorInterface $fileSystemAdaptor;

    public function __construct(FileSystemAdaptorInterface $fileSystemAdaptor)
    {
        $this->fileSystemAdaptor = $fileSystemAdaptor;
    }

    public function savePage(string $html, string $name, string $path): bool
    {
        return $this->fileSystemAdaptor->savePage($html, $name, $path);
    }
}