<?php

namespace App\Domain;

interface FileSystemRepositoryInterface
{
    public function saveFile(File $file): bool;

    public function deleteFile(string $path): void;
}