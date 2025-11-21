<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="">
</head>
<body>



<?php

// Definir la constante
define("N",5);
include_once 'Hobby.php';
include_once 'Cine.php';
include_once 'Lectura.php';
include_once 'Ayuda.php';
include_once 'Acciones.php';


// Opciones predefinidas para los atributos de los hobbies
$peliculas = ["Inception", "Interstellar", "Pulp Fiction", "La Matriz"];
$generosLectura = ["Ciencia Ficción", "Novela", "Misterio", "Fantasia"];
$formatosLectura = ["Tapa blanda", "Tapa dura", "Ebook"];
$libros = ["Cien años de soledad", "Don Quijote de la Mancha", "El principito", "El Señor de los Anillos"];
$areas = ["Ocio", "Interior", "Exterior", "Cafetería"];
$lugares = ["Biblioteca", "Cinesa", "Casa", "Parque"];
// Generar N actividades de hobby de forma aleatoria
echo "<h2>Generando " . N . " actividades de hobby aleatorias</h2>";

for ($i = 0; $i < N; $i++) {
	
	// Decidir aleatoriamente el hobby a instanciar
	$tipoHobby = rand(0, 1);

	if ($tipoHobby === 0) { // Instanciar porque ha salido el 1
		$pelicula = Ayuda::generarElementoAleatorio($peliculas);
		$duracion = Ayuda::generarEntero(90, 180);
		$area = Ayuda::generarElementoAleatorio($areas);
		$lugar = Ayuda::generarElementoAleatorio($lugares);
		$horas = Ayuda::generarEntero(1, 5);

		
		$hobby = new Cine($pelicula, $duracion, $area, $lugar, $horas);
		echo "<h2>Hobby " . ($i + 1) . ": Cine</h2>";
		echo $hobby;
	} else {
		$titulo = Ayuda::generarElementoAleatorio($libros);
		$genero = Ayuda::generarElementoAleatorio($generosLectura);
		$formato = Ayuda::generarElementoAleatorio($formatosLectura);
		$nPaginas = Ayuda::generarEntero(4, 70);
		$area = Ayuda::generarElementoAleatorio($areas);
		$lugar = Ayuda::generarElementoAleatorio($lugares);
		$horas = Ayuda::generarEntero(0, 6);
		// Aqui lo que hace: instanciar
		// El objeto, como antes cuando se ha instanciado en principal.php
		// Con los "atributos" que ha cogido aleatoriamente
		$hobby = new Lectura($titulo, $genero, $formato, $nPaginas, $area, $lugar, $horas);
		echo "<h2>Hobby " . ($i + 1) . ": Lectura</h2>";
		echo $hobby; // Mostrando
	}

	echo "<hr>";
}


?>
</body>









</html>