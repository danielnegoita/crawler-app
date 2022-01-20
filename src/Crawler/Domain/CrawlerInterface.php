<?php

namespace Crawler\Domain;

interface CrawlerInterface
{
    public function extractPageInternalLinks(Url $url): ?array;

    public function extractHtmlFromPage(Url $url): ?string;
}