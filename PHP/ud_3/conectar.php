<?php
$servername = "localhost";
$username = "dweb";
$password = "12345";
$dbname = "desarrollowebentornoservidor";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO usuarios (nombre,apellido,edad,clave,email,rol,email) 
  VALUES ('juan','lopez',55,'hola1',0,'juanlopez@gmail.com')";
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>