<?php

namespace App\Domain;

interface CrawlerInterface
{
    public function extractPageInternalLinks(Url $url): ?array;
}