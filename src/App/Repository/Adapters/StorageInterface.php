<?php

namespace App\Repository\Adapters;

interface StorageInterface
{
    public function connection(): \PDO;
}