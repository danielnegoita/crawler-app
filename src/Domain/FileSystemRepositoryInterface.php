<?php

namespace App\Domain;

interface FileSystemRepositoryInterface
{
    public function saveFile(File $file): void;

    public function deleteFile(string $path): void;
}