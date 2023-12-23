<?php

namespace App\ReadModel;

use App\ReadModel\Views\PostView;
use Monolog\DateTimeImmutable;
use PDO;

class PostReadRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function countAll(): array
    {
        $stmt = $this->pdo->query('SELECT COUNT(id) FROM posts');

        return $stmt->fetchColumn();
    }

    /**
     * @return PostView[]
     */
    public function getAll(int $offset, int $limit): array
    {
        $stmt = $this->pdo->query('SELECT * FROM posts ORDER BY id DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydratePost'], $rows);
    }

    public function find($id): ?PostView
    {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::FETCH_ASSOC);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydratePost($row) : null;
    }

    private function hydratePost($row): ?PostView
    {
        $view = new PostView(
            $row['id'],
            new DateTimeImmutable($row['date']),
            $row['title'],
            $row['content']
        );

        return $view;
    }
}
