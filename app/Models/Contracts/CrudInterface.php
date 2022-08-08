<?php

namespace App\Models\Contracts;

interface CrudInterface
{
    /**
     * Insert data to database.
     *
     * @param array $data
     * @return integer last inserted id
     */
    public function create(array $data): int;

    /**
     * Find record in database.
     *
     * @param integer $id
     * @return object|null specific record
     */
    public function find(int $id): ?self;

    /**
     * Get records from database.
     *
     * @param array|string $columns
     * @param array|null $where
     * @return array records
     */
    public function get(array|string $columns, ?array $where = null): array;

    /**
     * Update records.
     *
     * @param array $data
     * @param array|null $where
     * @return integer affected records
     */
    public function update(array $data, ?array $where = null): int;

    /**
     * Delete specific records.
     *
     * @param array $where
     * @return integer affected records
     */
    public function delete(array $where): int;
}
