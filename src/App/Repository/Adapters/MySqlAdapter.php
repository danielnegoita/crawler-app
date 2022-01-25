<?php

namespace App\Repository\Adapters;

use PDO;

class MySqlAdapter implements StorageInterface
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=127.0.0.1;dbname=crawler', 'root', 'root');
    }

    public function getLinksByPageUrl(string $url): ?array
    {
        $query = 'SELECT * FROM links WHERE page = ?';

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$url]);

        return $stmt->fetchAll();
    }
}