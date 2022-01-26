<?php

namespace Crawler\Domain\Model;

interface LinkRepositoryInterface
{
    public function persist(Link $link): void;

    public function save(): bool;

    public function deleteLinksByPageUrl(string $url): bool;
}