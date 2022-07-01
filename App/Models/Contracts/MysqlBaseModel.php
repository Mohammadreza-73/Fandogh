<?php

namespace App\Models\Contracts;

use App\Models\Contracts\BaseModel;

class MysqlBaseModel extends BaseModel
{
    public function __construct()
    {
        $dsn = $this->dsnGenerator();

        try {
            $this->connection = new \PDO(...$dsn);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

        } catch(\PDOException $e) {
            die('Database Connection failed: ' . $e->getMessage());
        }
    }

    public function create(array $data): int
    {
        return 1;
    }

    public function find(int $id): ?object
    {
        return null;
    }

    public function get(array $columns, array $where): array
    {
        return [];
    }

    public function update(array $data, array $where): int
    {
        return 1;
    }

    public function delete(array $where): int
    {
        return 1;
    }

    private function dsnGenerator()
    {
        $dsn = "{$_ENV['DB_CONNECTION']}:
                host={$_ENV['DB_HOST']};
                dbname={$_ENV['DB_DATABASE']};
                port={$_ENV['DB_PORT']};
                charset={$_ENV['DB_CHARSET']};";

        return [
            $dsn,
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
        ];
    }
}