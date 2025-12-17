<?php

require '../vendor/autoload.php';
class Conexion
{
    private $servername = "localhost";
    private $username = "dweb";
    private $password = "12345";
    private $bd = "dweb"; // Base de datos cambiada
    public $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servername;dbname=$this->bd", $this->username, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    public function getConexion()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servername;dbname=$this->bd", $this->username, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}