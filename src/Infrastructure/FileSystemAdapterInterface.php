<?php

namespace App\Infrastructure;

use App\Domain\File;

interface FileSystemAdapterInterface
{
    public function saveFile(File $file): bool;

    public function deleteFile(string $path): void;
}