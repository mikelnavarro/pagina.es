<?php

include_once 'Vehiculo.php';
class Coche extends Vehiculo {

	// Atributos
	private $modelo;
	private $plazas;
	private $combustible;

	// Constructor

	public function __construct($anio, $kilometraje, $modelo, $plazas, $combustible) {
		parent::__construct($anio, $kilometraje);
		$this->modelo = $modelo;
		$this->plazas = $plazas;
		$this->combustible = $combustible;
	}

	// Metodos
    // El método __toString() debe devolver una cadena, no imprimirla.
	public function __toString() {
		return "Vehiculo: Coche <br>"
		. "Modelo: " . $this->modelo . "<br>"
		. "Combustible: " . $this->combustible . "<br>"
		. "Plazas: " . $this->plazas . "<br>"
		. "Año: " . $this->anio . "<br>"
		. "Kilometraje: " . $this->kilometraje . "<br>";
	}
	// Accesores
	// Modificadores

	public function getModelo() {
		return $this->modelo;
	}
	public function getPlazas() {
		return $this->plazas;
	}
	public function getCombustible() {
		return $this->combustible;
	}
	public function setModelo($modelo) {
		$this->modelo = $modelo;
	}
	public function setPlazas($plazas) {
		$this->plazas = $plazas;
	}
	public function setCombustible($combustible) {
		$this->combustible = $combustible;
	}



	// Implementar metodos de la abstracta
	public function arrancarVehiculo() {
		echo "El vehiculo (coche) del modelo " . $this->modelo . "esta arrancando." . "<br>";
	}


}






?>