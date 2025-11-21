<?php


class Notificador implements Enviador, Notificador {

	public function enviar(string$mensaje):void {
		echo "Enviando mensaje: $mensaje";
	}
	public function registrar(string:$mensaje):void {
		echo "Registrando mensaje: $mensaje";
	}
}


interface Enviador {

	// Metodos de la interfaz
	public function enviar(string$mensaje):void;
}


interface Registrador {

	// Metodos de la interfaz
	public function registrar(string$mensaje):void;


}




?>