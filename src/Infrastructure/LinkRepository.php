<?php

namespace App\Infrastructure;

use App\Domain\Model\Link;
use App\Domain\Model\LinkRepositoryInterface;
use App\Infrastructure\Adapters\StorageAdaptorInterface;

class LinkRepository implements LinkRepositoryInterface
{
    private array $links = [];

    private StorageAdaptorInterface $storageAdaptor;

    public function __construct(StorageAdaptorInterface $storageAdaptor)
    {
        $this->storageAdaptor = $storageAdaptor;
    }

    public function persist(Link $link): void
    {
        array_push($this->links, $link->toArray());
    }

    public function save(): bool
    {
        return $this->storageAdaptor->saveLinks($this->links);
    }
}