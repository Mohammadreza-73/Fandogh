<?php

namespace App\Models\Contracts;

use Medoo\Medoo;
use App\Models\Contracts\BaseModel;

class MysqlBaseModel extends BaseModel
{
    public function __construct()
    {
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
    }

    public function create(array $data): int
    {
        $this->connection->insert($this->table, $data);

        return $this->connection->id();
    }

    public function find(int $id): ?object
    {
        return (object) $this->connection->get($this->table, '*', [$this->primary_key => $id]);
    }

    /**
     * Find a record or throw exception.
     *
     * @param integer $id
     * @throws InvalidArgumentException
     * @return object
     */
    public function findOrFail(int $id): object
    {
        $data = $this->connection->get($this->table, '*', [$this->primary_key => $id]);
        
        if (! isset($data)) {
            throw new \InvalidArgumentException(
                "Record with id: {$id} does not exist."
            );
        }

        return (object) $data;
    }

    public function get(array|string $columns, ?array $where = null): array
    {
        return $this->connection->select($this->table, $columns, $where);
    }

    public function update(array $data, ?array $where = null): int
    {
        $data = $this->connection->update($this->table, $data, $where);

        return $data->rowCount();
    }

    public function delete(array $where): int
    {
        $data = $this->connection->delete($this->table, $where);

        return $data->rowCount();
    }

    /**
     * Delete a record by id.
     *
     * @param integer $id
     * @return integer affected row
     */
    public function remove(int $id): int
    {
        $id = $this->findOrFail($id)->id;

        return $this->delete(['id' => $id]);
    }
}