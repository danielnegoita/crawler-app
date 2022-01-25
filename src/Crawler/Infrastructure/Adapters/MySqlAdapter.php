<?php

namespace Crawler\Infrastructure\Adapters;

use Crawler\Infrastructure\StorageAdaptorInterface;

class MySqlAdapter implements StorageAdaptorInterface
{
    public function saveLinks(array $links): bool
    {
        // TODO: Implement saveLinks() method.
        return true;
    }
}