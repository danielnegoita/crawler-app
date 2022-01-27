<?php

namespace App\Repository;

use App\Repository\Adapters\StorageInterface;

class IssueRepository implements IssueRepositoryInterface
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getAllIssues(): ?array
    {
        $query = 'SELECT * FROM issues ORDER BY id DESC';

        $stmt = $this->storage->connection()->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}