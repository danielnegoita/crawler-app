<?php

namespace Crawler\Domain\Model;

use Crawler\Domain\Url;
use Crawler\Domain\Model\Traits\SoftDeleteable;
use Crawler\Domain\Model\Traits\Timestampable;

final class Link
{
    use Timestampable, SoftDeleteable;

    private string $link;

    private string $page;

    private function __construct(Url $link, string $page)
    {
        $this->setLink($link->toString());
        $this->setPage($page);
        $this->setCreatedAt();
        $this->setUpdatedAt();
    }

    public static function create(Url $link, string $page): self
    {
        return new self($link, $page);
    }

    public function link(): Url
    {
        return Url::fromString($this->link);
    }

    public function page(): string
    {
        return $this->page;
    }

    private function setLink(string $link): void
    {
        $this->link = $link;
    }

    private function setPage(string $page): void
    {
        $this->page = $page;
    }

    public function toArray(): array
    {
        return [
            'link' => $this->link()->toString(),
            'page' => $this->page()
        ];
    }
}