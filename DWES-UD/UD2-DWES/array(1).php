<?php


$colores = ["rojo", "verde", "azul", "amarillo"];
echo "<h2>Colores:</h2>";


foreach ($colores as $c) {
	echo $c . "<br>";
}

$producto = [
	"nombre" => "Camiseta",
	"precio" => 19.99.
	"stock" => 15
];
echo "<h2>Productos:<h2>";


foreach ($producto as $clave => $valor) {
	echo ucfirst($clave( - ": " . $valor . "<br>";
}
?>