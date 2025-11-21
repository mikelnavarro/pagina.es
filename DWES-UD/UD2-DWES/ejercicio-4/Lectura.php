<?php

include_once 'Acciones.php';
include_once 'Hobby.php';
class Lectura extends Hobby {


	// Atributos
	private $titulo;
	private $genero;
	private $formato;
	private $nPaginas;

	// Constructores
	public function __construct($titulo, $genero, $formato, $nPaginas, $area, $lugar, $horas) {
        parent::__construct($area, $lugar, $horas); // Constructor Padre
		$this->titulo = $titulo;
		$this->genero = $genero;
		$this->formato = $formato;
		$this->nPaginas = $nPaginas;
	}

	// Modificadores

	

	

	public function getTitulo() {
		return $this->titulo;
	}
	public function getGenero() {
		return $this->genero;
	}
	public function getFormato() {
		return $this->formato;
	}
	public function getnPaginas() {
		return $this->nPaginas;
	}
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function setGenero($genero) {
		$this->genero = $genero;
	}
	public function setFormato($formato) {
		$this->formato = $formato;
	}
	public function setnPaginas($nPaginas) {
		$this->nPaginas = $nPaginas;
	}



	// Metodos

	public function leoGenero() {
		return "Leo libros de {$this->genero} <br>";
	}





	public function compartoCon() {
        return "La lectura se comparte generalmente...";
    }

    public function practicarHobby() {
        return "Practicar la lectura...";
    }




	// Implementando metodos de la interfaz Acciones
    public function realizarAccion() {
        return "El hobby de lectura se está realizando en el lugar: " . $this->lugar . ".";
    }
	public function detenerAccion() {
		echo "Terminando lectura del libro $this->titulo de $this->genero. Página: $this->nPaginas.";
	}

	// Metodo toString
	public function __toString() {
		return "Hobby: Lectura <br>"
        . "Titulo: " . $this->titulo . "<br>"
        . "Género: " . $this->genero . "<br>"
        . "Formato: " . $this->formato . "<br>"
        . "Número de páginas: " . $this->nPaginas . "<br>"
        . "Área: " . $this->area . "<br>"
        . "Lugar: " . $this->lugar . "<br>"
        . "Horas: " . $this->horas . "<br>";
	}

}