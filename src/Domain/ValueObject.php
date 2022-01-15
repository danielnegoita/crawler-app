<?php

namespace App\Domain;

interface ValueObject
{
    public function equals(self $anObject): bool;
}
