<?php

namespace Crawler\Infrastructure;


interface StorageAdaptorInterface
{
    public function saveLinks(array $links): bool;

    public function deleteLinksByPageUrl(string $url): bool;

    public function saveIssue(array $issues): bool;
}