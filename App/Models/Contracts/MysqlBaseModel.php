<?php

namespace App\Models\Contracts;

use Medoo\Medoo;
use App\Models\Contracts\BaseModel;

class MysqlBaseModel extends BaseModel
{
    public function __construct()
    {
        try {
            $this->connection = new Medoo([
                'type' => $_ENV['DB_CONNECTION'],
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_DATABASE'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
             
                'charset' => $_ENV['DB_CHARSET'],
                'collation' => 'utf8mb4_general_ci',
                'port' => $_ENV['DB_PORT'],
             
                'prefix' => $_ENV['DB_PREFIX'],
                'logging' => $_ENV['DB_LOGGING'],
             
                /**
                 * @example PDO::ERRMODE_SILENT (default) | PDO::ERRMODE_WARNING | PDO::ERRMODE_EXCEPTION
                 * @see Read more from https://www.php.net/manual/en/pdo.error-handling.php.
                 */
                'error' => \PDO::ERRMODE_EXCEPTION,
             
                /**
                 * The driver_option for connection.
                 * 
                 * @see Read more from http://www.php.net/manual/en/pdo.setattribute.php.
                 */
                'option' => [
                    // PDO::ATTR_CASE => PDO::CASE_NATURAL
                ],
            ]);

        } catch (\PDOException $e) {
            die('Database Connection Failed: ' . $e->getMessage());
        }
        
    }

    public function create(array $data): int
    {
        $this->connection->insert($this->table, $data);

        return $this->connection->id();
    }

    public function find(int $id): ?object
    {
        return null;
    }

    public function get(array|string $columns, ?array $where = null): array
    {
        return $this->connection->select($this->table, $columns, $where);
    }

    public function update(array $data, array $where): int
    {
        return 1;
    }

    public function delete(array $where): int
    {
        return 1;
    }
}