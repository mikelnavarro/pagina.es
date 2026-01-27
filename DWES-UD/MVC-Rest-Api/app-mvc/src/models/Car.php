<?php
namespace Mikelnavarro\AppMvc\Models;
use Cls\Mvc2app\Db;
use Mikelnavarro\AppMvc\Config;
class Car
{
    private $db;

    private $id;
    private $brand;
    private $model;
    private $color;
    private $owner;
    public function __construct($id = 0, $brand = '', $model = '', $color = '', $owner = '')
    {
        $this->db = new Db();
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->owner = $owner;
    }


    public function getAll(): array {
        $this->db->query('SELECT * FROM cars');
        $restult = $this->db->registrosAssoc();
        return $restult;
    }
    public function getById(int $id): ?array {
        $this->db->query('SELECT * FROM cars WHERE id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $row = $this->db->registroAssoc();
        return $row ?: null;
    }
    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getBrand(): mixed
    {
        return $this->brand;
    }

    public function setBrand(mixed $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): mixed
    {
        return $this->model;
    }

    public function setModel(mixed $model): void
    {
        $this->model = $model;
    }

    public function getColor(): mixed
    {
        return $this->color;
    }

    public function setColor(mixed $color): void
    {
        $this->color = $color;
    }

    public function getOwner(): mixed
    {
        return $this->owner;
    }

    public function setOwner(mixed $owner): void
    {
        $this->owner = $owner;
    }


}