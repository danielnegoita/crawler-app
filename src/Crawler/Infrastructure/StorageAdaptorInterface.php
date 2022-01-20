<?php

namespace Crawler\Infrastructure;


interface StorageAdaptorInterface
{
    public function saveLinks(array $links): bool;
}