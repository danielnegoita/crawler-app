<?php

namespace App\Domain\Model;

use App\Domain\Model\Traits\SoftDeleteable;
use App\Domain\Model\Traits\Timestampable;

final class Link
{
    use Timestampable, SoftDeleteable;

    private string $link;

    private string $page;

    private function __construct(string $link, string $page)
    {
        $this->setLink($link);
        $this->setPage($page);
        $this->setCreatedAt();
        $this->setUpdatedAt();
    }

    public static function create(string $link, string $page): self
    {
        return new self($link, $page);
    }

    public function link(): string
    {
        return $this->link;
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
}