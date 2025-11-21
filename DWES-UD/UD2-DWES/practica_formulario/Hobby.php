<?php


include_once 'Acciones.php';
abstract class Hobby implements Acciones {

	// Atributos
	protected $area;
	protected $lugar;
	protected $horas;

	// Constructores
	public function __construct($area, $lugar, $horas){
		$this->area = $area;
		$this->lugar = $lugar;
		$this->horas = $horas;
	}



	// Getters y Setters

	public function getArea() {
		return $this->area;
	}
	public function getLugar() {
		return $this->lugar;
	}
	public function getHoras() {
		return $this->horas;
	}
	public function setHoras($horas) {
		$this->horas = $horas;
	}

    // El método realizarAccion() es abstracto porque se hereda de la interfaz,
    // y debe ser implementado en las clases hijas.
    abstract public function realizarAccion();
    abstract public function detenerAccion();



	// Metodos
	abstract public function compartoCon();
	abstract public function practicarHobby();


}




?>