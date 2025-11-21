<?php
function generarCadena1() {

    $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$longitud = 10;
	$cadena_aleatoria = ' ';
	$longitud = strlen($caracteres_permitidos);
    for ($d = 0; $d <= $longitud; $d++) {
		$cadena_aleatoria .= $caracteres_permitidos[random_int(1, $longitud - 1)];
	}
	return $cadena_aleatoria;
}
echo generarCadena1();

function generarCadena2() {
    $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 10;
    echo substr(str_shuffle($caracteres_permitidos), 1, $longitud);
}
echo "<br>";
echo generarCadena2();
echo "<br>";


function cadenaAleatoria($longitud = 10, $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	$cadena = ' ';
	$max = mb_strlen($caracteres) - 1;
	for ($i = 0; $i < $longitud; $i++) {
		$cadena .= mb_substr($caracteres, random_int(1, $max), 1);
	}
	return $cadena;
}



// Generar una contraseña
echo cadenaAleatoria(10);
// Rellenar una quiniela
echo cadenaAleatoria(14, '111XX2');
function cadena1() {
    // Para una cadena legible (hexadecimal)
    $bytes = random_bytes(16); // Genera 16 bytes aleatorios
    $cadena_hex = bin2hex($bytes); // Convierte los bytes a hexadecimal
    echo $cadena_hex;

    // Para una cadena alfanumérica con random_int
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $longitud = 12;
    $cadena = '';
    for ($i = 0; $i < $longitud; $i++) {
        $cadena .= $caracteres[random_int(0, strlen($caracteres) - 1)];
    }
	return $cadena;
}
echo "<br>";

echo cadena1();


/* function generarEntero() {
    $entero = 0;
    echo rand(100,9999999)

}



*/
?>