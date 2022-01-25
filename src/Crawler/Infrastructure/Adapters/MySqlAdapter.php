<?php

namespace Crawler\Infrastructure\Adapters;

use PDO;
use Crawler\Infrastructure\StorageAdaptorInterface;

class MySqlAdapter implements StorageAdaptorInterface
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

    public function saveLinks(array $links): bool
    {
        $query = 'INSERT INTO links (link, page)
                  VALUES (?, ?)';

        $stmt = $this->connection->prepare($query);

        foreach ($links as $link) {
            $stmt->execute([ $link['link'], $link['page'] ]);
        }

        return !!$this->connection->lastInsertId();
    }
}