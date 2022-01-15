<?php

namespace App\Domain\Model;

use DateTime;
use DateTimeInterface;

final class Link
{
    private string $link;

    private string $page;

    private DateTimeInterface $deletedAt;

    private DateTimeInterface $createdAt;

    private DateTimeInterface $updatedAt;

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

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    private function setLink(string $link): void
    {
        $this->link = $link;
    }

    private function setPage(string $page): void
    {
        $this->page = $page;
    }

    private function setCreatedAt(?DateTimeInterface $createdAt = null): void
    {
        $this->createdAt = $createdAt ?? new DateTime();
    }

    private function setUpdatedAt(?DateTimeInterface $updatedAt = null): void
    {
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}