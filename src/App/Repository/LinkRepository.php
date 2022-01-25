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
        $query = 'SELECT * FROM links WHERE page = ?';

        $stmt = $this->storage->connection()->prepare($query);
        $stmt->execute([$url]);

        return $stmt->fetchAll();
    }
}