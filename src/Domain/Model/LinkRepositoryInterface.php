<?php

namespace App\Domain\Model;

interface LinkRepositoryInterface
{
    public function persist(Link $link): void;

    public function save(): bool;
}