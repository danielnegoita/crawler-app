<?php

namespace App\Infrastructure\Adapters;


interface StorageAdaptorInterface
{
    public function saveLinks(array $links): bool;
}