<?php

namespace Crawler\Domain;

interface ValueObject
{
    public function equals(self $anObject): bool;
}
