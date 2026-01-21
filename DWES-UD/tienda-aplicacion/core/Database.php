<?php
require_once 'Config.php';
class Database
{
    private $conn;
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    public function getConnection()
    {
        return $this->conn->conexion;
    }


}