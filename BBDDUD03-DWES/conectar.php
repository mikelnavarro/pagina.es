<?php
$servername = "localhost";
$username = "dweb";
$password = "12345";
$dbname = "desarollowebentornoservidor";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "INSERT INTO usuarios (nombre, apellido, edad, clave, rol, email)
  VALUES ('John', 'Doe', 20, 'AB123', 0, 'john@example.com')";
$conn->exec($sql);
  echo "New record created successfully";
  
  echo "New record created successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>