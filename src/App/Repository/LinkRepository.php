<?php

namespace App\Repository;

use App\Repository\Adapters\StorageInterface;

class LinkRepository implements LinkRepositoryInterface
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getInternalLinks(string $url): ?array
    {
        return $this->storage->getLinksByPageUrl($url);
    }
}