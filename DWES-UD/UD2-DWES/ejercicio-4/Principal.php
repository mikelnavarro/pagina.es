<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
  	<?php
define("N",5);
include_once 'Hobby.php';
include_once 'Cine.php';
include_once 'Lectura.php';
include_once 'Ayuda.php';
include_once 'Acciones.php';



// Instanciar objetos Lectura con libros
$miLectura = new Lectura("Cien años de soledad", "Novela", "Tapa blanda", 240, "Ocio", "Presencial", 10);
$miCine = new Cine("Inception", 1.48, "Ocio", "Cinesa", 2);

	echo $miLectura;
	echo "<br>";
	echo $miCine;
	echo "<br>";

// Usar el metodo implementado de la interfaz
echo $miLectura->realizarAccion();
echo "<br>";
echo $miCine->realizarAccion();
echo "<br>";
echo $miLectura->detenerAccion();
echo "<hr>";
echo $miCine->detenerAccion();
echo "<br>";
echo $miLectura->compartoCon();
echo "<br>";
echo $miLectura->practicarHobby();
echo "<br>";
echo $miLectura->leoGenero();
echo "<br>";
echo "<br>";
echo "<hr>";




// Establecer tiempo máximo y mínimo usando los métodos del trait
$miCine->setTiempoMinimo(1);
$miCine->setTiempoMaximo(7);
if ($miCine->tiempoValido()) {
    echo "El tiempo dedicado es válido (entre " . $miCine->getTiempoMinimo() . " y " . $miCine->getTiempoMaximo() . " horas).";
} else {
    echo "El tiempo dedicado no es válido.";
}
echo "<hr>";

/*


Genera N actividades distintas de tu hobby instanciando N objetos de tu clase de forma aleatoria en
	la clase Principal, usando la clase de la práctica dos. 
  
  
  

  */


// Opciones predefinidas para los atributos de los hobbies
$peliculas = ["Inception", "Interstellar", "Pulp Fiction", "El mago de Oz"];
$generosLectura = ["Ciencia Ficción", "Novela", "Misterio", "Fantasia"];
$formatosLectura = ["Tapa blanda", "Tapa dura", "e-book"];
$libros = ["Cien años de soledad", "Don Quijote de la Mancha", "El principito", "El Señor de los Anillos"];
$lugares = ["Cinesa", "Cines Arcca", "Cines Yelmo", "Casa", "Parque"];
$lugaresLeer = ["Biblioteca", "Casa", "Cafeteria", "Parque"];
// Generar N actividades de hobby de forma aleatoria
echo "<h2>Generando " . N . " actividades de hobby aleatorias</h2>";


for ($i = 0; $i < N; $i++) {
	
	// Decidir aleatoriamente el hobby a instanciar
	$tipoHobby = rand(0, 1);

	if ($tipoHobby === 0) { // Instanciar porque ha salido el 1
		$pelicula = Ayuda::generarElementoAleatorio($peliculas);
		$duracion = Ayuda::generarEntero(90, 180);
		$area = "Ocio";
		$lugar = Ayuda::generarElementoAleatorio($lugares);
		$horas = Ayuda::generarEntero(1, 5);

		
		$hobby = new Cine($pelicula, $duracion, $area, $lugar, $horas);
		echo "<p>Hobby " . ($i + 1) . ": Cine</p>";
		echo $hobby;
		echo $hobby->realizarAccion();
		echo "<br>";
		echo $hobby->detenerAccion();
	} else {
		$titulo = Ayuda::generarElementoAleatorio($libros);
		$genero = Ayuda::generarElementoAleatorio($generosLectura);
		$formato = Ayuda::generarElementoAleatorio($formatosLectura);
		$nPaginas = Ayuda::generarEntero(4, 70);
		$area = "Ocio";
		$lugar = Ayuda::generarElementoAleatorio($lugaresLeer);
		$horas = Ayuda::generarEntero(0, 6);
		// Aqui lo que hace: instanciar
		// El objeto, como antes cuando se ha instanciado en principal.php
		// Con los "atributos" que ha cogido aleatoriamente
		$hobby = new Lectura($titulo, $genero, $formato, $nPaginas, $area, $lugar, $horas);
		echo "<p>Hobby " . ($i + 1) . ": Lectura</p>";
		echo $hobby; // Mostrando
		echo $hobby->realizarAccion();
		echo $hobby->detenerAccion();
	}
	echo "<hr>";
}
?>
  </body>
</html>