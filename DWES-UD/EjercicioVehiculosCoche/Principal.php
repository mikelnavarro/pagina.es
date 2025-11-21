<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
include_once 'Vehiculo.php';
include_once 'Coche.php';


  // Instanciado un objeto
  $coche1 = new Coche("Ford Focus", 5, "Gasolina", 2020, 50000);



$coche1->arrancarVehiculo(); // Salida: El vehiculo (coche) del modelo Ford Focus esta arrancando...






    ?>
  </body>
  </html>