<?php

abstract class Vehiculo {

	// Atributos
	protected $anio;
	protected $kilometraje;

	
	public function __construct($anio, $kilometraje) {
		$this->anio = $anio;
		$this->kilometraje = $kilometraje;
	}

	// Metodos
	public function __toString() {
		return "Kilometraje: " . $this->kilometraje . "<br>"
		. "Año: " . $this->anio . "<br>";
	}
	// Modificadores
	public function getAnio() {
		return $this->anio;
	}
	public function getKilometraje() {
		return $this->kilometraje;
	}
	public function setAnio($anio) {
		$this->anio = $anio;
	}
	public function setKilometraje($kilometraje) {
		$this->kilometraje = $kilometraje;
	}

	abstract public function arrancarVehiculo();







}


?>