<?php

namespace App\Infrastructure;

use App\Domain\File;

interface FileSystemAdapterInterface
{
    public function savePage(File $file): bool;
}