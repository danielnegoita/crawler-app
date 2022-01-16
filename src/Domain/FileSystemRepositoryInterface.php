<?php

namespace App\Domain;

interface FileSystemRepositoryInterface
{
    public function savePage(string $html, string $name, string $path): bool;
}