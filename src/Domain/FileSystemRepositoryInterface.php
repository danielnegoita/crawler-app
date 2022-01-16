<?php

namespace App\Domain;

interface FileSystemRepositoryInterface
{
    public function savePage(File $file): bool;
}