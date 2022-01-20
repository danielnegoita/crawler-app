<?php

namespace Crawler\Infrastructure;

use Crawler\Domain\File;

interface FileSystemAdapterInterface
{
    public function saveFile(File $file): void;

    public function deleteFile(string $path): void;
}