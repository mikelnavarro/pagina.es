<?php
/* declaración de variables */
$entero = 4; // tipo integer
$numero = 4.5; // tipo double
$cadena = "cadena"; // tipo cadena
$bool = TRUE; // tipo booleano
/* cambio de tipo de una variable */
$a = 5; // entero
echo gettype($a); // imprime el tipo de dato de a
echo "<br>";
$a = "Hola"; // cambia a cadena
echo gettype($a); // se comprueba que ha cambiado
$var1 = 100;
$var2 = &$var1; // asignacion por referencia
$var3 = $var1; // asignacion por copia
echo "$var2<br>"; // muestra 100
$var2 = 300; // cambia el valor de $var2
echo "$var1<br>"; // $var1 tambien cambia
$var3 = 400; // este cambio no afecta a $var1
echo $var1;