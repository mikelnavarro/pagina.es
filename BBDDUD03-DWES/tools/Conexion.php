<?php


class Conexion {
  private $servername = "localhost";
  private $username = "dweb";
  private $password = "12345";
  private $dname = "desarollowebentornoservidor";
  private $conexion;

  public function __construct() {
    $this->conexion = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    if ($this->conexion->connect_error) {
      echo "Error de conexión: " . $this->conexion->connect_error;
        }
    $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 ?>