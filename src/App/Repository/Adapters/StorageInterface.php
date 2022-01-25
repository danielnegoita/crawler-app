<?php

namespace App\Repository\Adapters;

interface StorageInterface
{
    public function getLinksByPageUrl(string $url): ?array;
}