<?php

namespace App\Models\Contracts;

use App\Models\Contracts\BaseModel;

class JsonBaseModel extends BaseModel
{
    /**
     * Json file path.
     *
     * @var string
     */
    private $db_folder;

    private $json_file_path;

    public function __construct()
    {
        $this->db_folder = BASE_PATH . '/storage/jsondb/';
        $this->json_file_path = $this->db_folder . $this->table . '.json';
    }

    public function create(array $data): int
    {
        $json_data = $this->getFileContents();
        $json_data[] = $data;
        $this->putFileContents($json_data);
        
        return $data[$this->primary_key];
    }

    public function find(int $id): ?object
    {
        $json_data = $this->getFileContents();

        foreach ($json_data as $object) {
            if ($object->{$this->primary_key} === $id) return $object;
        }

        return null;
    }

    public function get(array $columns, array $where): array
    {
        return [];
    }

    public function all()
    {
        return $this->getFileContents();
    }

    public function update(array $data, array $where): int
    {
        return 1;
    }

    public function delete(array $where): int
    {
        return 1;
    }

    private function getFileContents(): array
    {
        return json_decode(file_get_contents($this->json_file_path));

    }

    private function putFileContents(array $json_data)
    {
        $json = json_encode($json_data);

        return file_put_contents($this->json_file_path, $json);
    }
}