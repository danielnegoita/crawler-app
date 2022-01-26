<?php

namespace Crawler\Infrastructure;

use Crawler\Domain\Model\Link;
use Crawler\Domain\Model\LinkRepositoryInterface;
use Crawler\Domain\Url;

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

    public function deleteLinksByPageUrl(string $url): bool
    {
        return $this->storageAdaptor->deleteLinksByPageUrl($url);
    }
}