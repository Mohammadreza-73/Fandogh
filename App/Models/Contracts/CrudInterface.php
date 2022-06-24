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
     * @return object specific record
     */
    public function find(int $id): object;

    /**
     * Get records from database.
     *
     * @param array $columns
     * @param array $where
     * @return array records
     */
    public function get(array $columns, array $where): array;

    /**
     * Update records.
     *
     * @param array $data
     * @param array $where
     * @return integer affected records
     */
    public function update(array $data, array $where): int;

    /**
     * Delete specific records.
     *
     * @param array $where
     * @return integer affected records
     */
    public function delete(array $where): int;
}