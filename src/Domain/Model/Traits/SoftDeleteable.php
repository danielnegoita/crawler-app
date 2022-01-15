<?php

namespace App\Domain\Model\Traits;

use DateTimeInterface;

trait SoftDeleteable
{
    protected DateTimeInterface $deletedAt;

    public function deletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
