<?php

namespace App\Repository\Adapters;

use PDO;

class MySqlAdapter implements StorageInterface
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=127.0.0.1;dbname=crawler', 'root', 'root', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }

    public function connection(): PDO
    {
        return $this->connection;
    }
}