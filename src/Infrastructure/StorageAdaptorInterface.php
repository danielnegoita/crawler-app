<?php

namespace App\Infrastructure;


interface StorageAdaptorInterface
{
    public function saveLinks(array $links): bool;
}