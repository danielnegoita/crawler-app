<?php

namespace App\Infrastructure;

use App\Domain\File;

interface FileSystemAdapterInterface
{
    public function saveFile(File $file): void;

    public function deleteFile(string $path): void;
}