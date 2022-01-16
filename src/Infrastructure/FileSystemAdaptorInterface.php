<?php

namespace App\Infrastructure;

use App\Domain\File;

interface FileSystemAdaptorInterface
{
    public function savePage(File $file): bool;
}