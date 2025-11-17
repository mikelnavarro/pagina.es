<?php
$servername = "localhost";
$username = "dweb";
$password = "12345";
$dbname = "desarollowebentornoservidor";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



  
  
  $sql = "SELECT id, nombre, apellido, edad, rol FROM usuarios";
  $resul = $conn->query($sql);

  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}