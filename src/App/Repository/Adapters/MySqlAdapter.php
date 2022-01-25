<?php

namespace App\Repository\Adapters;

use PDO;

class MySqlAdapter implements StorageInterface
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO(
            'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ ]
        );
    }

    public function connection(): PDO
    {
        return $this->connection;
    }
}