<?php

namespace App\Infrastructure;

interface FileSystemAdaptorInterface
{
    public function savePage(string $html, string $name, string $path): bool;
}