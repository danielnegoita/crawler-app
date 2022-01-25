<?php


namespace App\Repository;


interface LinkRepositoryInterface
{
    public function getInternalLinks(string $url): ?array;
}