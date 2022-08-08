<?php

namespace App\Models\Contracts;

abstract class BaseModel implements CrudInterface
{
    /**
     * Database connection.
     *
     * @var object
     */
    protected $connection;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Table primary key.
     *
     * @var string
     */
    protected $primary_key = 'id';

    /**
     * Page size of result.
     *
     * @var integer
     */
    protected $per_page = 15;

    /**
     * Table column name.
     *
     * @var array
     */
    protected $attributes = [];

    protected function __construct()
    {
    }

    /**
     * Get a value of a column from table.
     *
     * @param string $key
     * @return string|null
     */
    protected function getAttributes(string $key): ?string
    {
        if (! isset($key) || ! array_key_exists($key, $this->attributes)) {
            return null;
        }

        return $this->attributes[$key];
    }

    public function __get(string $key)
    {
        return $this->getAttributes($key);
    }

    public function __set(string $key, $value)
    {
        if (! array_key_exists($key, $this->attributes)) {
            return null;
        }

        $this->attributes[$key] = $value;
    }
}
