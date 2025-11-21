<?php


class Ayuda {
	

	// Atributos
	private $cadena;
	private $num;
	// Constructores

	public function __construct($cadena, $num) {
		$this->cadena = $cadena;
		$this->num = $num;
	}





	// Métodos


	public function __toString() {
		return "Cadena aleatoria: $cadena
		  <br> Numero: $num";
	}

	public static function generarDecimalAleatorio($min, $max): float {
    $enteroAleatorio = mt_rand($min * 100, $max * 100); // Genera un número entero aleatorio en un rango ampliado (multiplicando por 100)
	// Divide el número entero entre 100 para obtener dos decimales
    $decimal = $enteroAleatorio / 100;
    return round($decimal, 2); // La función round() asegura que el resultado tenga la precisión deseada
    }

	public static function generarIsbn($longitud = 10) {
    $caracteres_permitidos = '0123456789';
    $cadena = '';
    $cadena = substr(str_shuffle($caracteres_permitidos), 1, $longitud);
    return $cadena;
	}
	public static function generarEntero($min = 3, $max = 140) {

    return rand($min,$max);
	}

	// Método extra para generar un elemento aleatorio de un array
    public static function generarElementoAleatorio(array $opciones) {
        return $opciones[array_rand($opciones)];
    }





}





?>