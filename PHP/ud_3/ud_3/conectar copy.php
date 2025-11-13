<?php
$servername = "localhost";
$username = "dweb";
$password = "12345";
$dbname = "desarollowebentornoservidor";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "INSERT INTO usuarios (nombre, apellido, edad, clave, rol, email) VALUES 
  ('John', 'Doe', 20, 'AB123', 0, 'john@example.com')";




  $ins = "INSERT INTO usuarios (nombre, apellido, edad, clave, rol, email)
  VALUES ('Alberto', 'López', '33333', 35, 0, 'albertolopez2@email.es')";


  $conn->exec($sql);
  $resul = $conn->query($ins);
  
  
  if ($resul){
    echo "insert correcto<br>";
    echo "filas insertadas: " . $resul->rowCount() . "<br>";
  } else print_r( $conn ->errorinfo());

  echo "Código de la fila" .$conn->lastInsertId()."<br>";
  // actualizar
  
  $upd = "UPDATE usuarios set rol = 0 where rol = 1";
  $resul = $conn->query($upd);
  if ($resul){
    echo "update correcto <br>";
    echo "filas actualizadas" .$resul->rowCount() ."<br>";
  } else print_r($conn-> errorinfo());
  $del = "DELETE FROM usuarios WHERE nombre = 'Alberto'";
  $resul = $conn->query($del);
  if ($resul){
    echo "delete correcto<br>";
    echo "filas borradas " .$resul->rowCount() ."<br>";
  } else print_r($conn->errorinfo());
  echo "New record created successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>