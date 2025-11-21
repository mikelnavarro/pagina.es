<?php


$tienda = 
[
	[
		"nombre" => "Camiseta",
		"precio" => 19.99,
		"stock" => 15
	],
	[
		"nombre" => "Pantalon",
		"precio" => 17.99,
		"stock" => 20
	],
	[
		"nombre" => "Zapatos",
		"precio" => 29.99,
		"stock" => 2
	]
];


$tienda =
[
	"producto" => ["Camiseta", 19.99, 15],
	"producto" => ["Pantalon", 17.99, 20]
];

echo "<h2>Catalogo:</h2>";
foreach ($tienda as $producto) {
	echo $producto["nombre"] . " - $" . $producto["precio"] . "(Stock: " . $producto["stock"] . ")<br>";

}
?>
		