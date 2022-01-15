<?php

namespace App\Domain\Model\Traits;

use DateTime;
use DateTimeInterface;

trait Timestampable
{
    protected DateTimeInterface $createdAt;

    protected DateTimeInterface $updatedAt;

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt = null): void
    {
        $this->createdAt = $createdAt ?? new DateTime();
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt = null): void
    {
        $this->updatedAt = $updatedAt ?? new DateTime();
    }
}
