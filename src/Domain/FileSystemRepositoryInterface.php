<?php

namespace App\Domain;

interface FileSystemRepositoryInterface
{
    public function saveFile(File $file): bool;
}