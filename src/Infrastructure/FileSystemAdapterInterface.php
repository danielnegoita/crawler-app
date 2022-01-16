<?php

namespace App\Infrastructure;

use App\Domain\File;

interface FileSystemAdapterInterface
{
    public function saveFile(File $file): bool;
}