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

    public function deleteLinksByPageUrl(string $url): bool
    {
        $query = 'DELETE FROM links WHERE page = ?';

        $stmt = $this->connection->prepare($query);

        return $stmt->execute([$url]);
    }

    public function saveIssue(array $exception): bool
    {
        $query = 'INSERT INTO issues (issue, level, status)
                  VALUES (?, ?, ?)';

        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            $exception['message'],
            $exception['level_name'],
            'unhandled'
        ]);

        return !!$this->connection->lastInsertId();
    }
}