<?php

namespace App\Repository;

interface CrawlerRepositoryInterface
{
    public function crawl(string $url);
}