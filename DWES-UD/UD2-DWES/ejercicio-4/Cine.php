<?php
include_once 'ContadorTiempo.php';
include_once 'Acciones.php';
include_once 'Hobby.php';
// Creación de clase
class Cine extends Hobby {
    use ContadorTiempo;
    // Atributos
    private $pelicula;
    private $duracion;

    // Constructor
    public function __construct($pelicula, $duracion, $area, $lugar, $horas) {
        parent::__construct($area, $lugar, $horas); // Constructor Padre
        $this->pelicula = $pelicula;
        $this->duracion = $duracion;
    }



    // Modificadores

    public function getPelicula() {
        return $this->pelicula;
    }
    public function getDuracion() {
        return $this->duracion;
    }
    public function setPelicula($pelicula) {
        $this->pelicula = $pelicula;
    }
    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }


    public function compartoCon() {
        return "El cine se comparte generalmente...";
    }

    public function practicarHobby() {
        return "Practicar cine consiste en...";
    }
    // Implementación del método abstracto de la interfaz
    public function realizarAccion() {
        return "El hobby de ir al cine se está realizando en: " . $this->lugar . ".";
    }
    public function detenerAccion() {
        return "El hobby de ir al cine ha sido detenido. Horas dedicadas: " . $this->horas . "<br>" . "La duración es: " . $this->duracion . " h <br>";
    }

    // Métodos
    public function __toString() {
        return "Hobby: Cine <br>"
                . "Pelicula: " . $this->pelicula . "<br>"
                . "Duracion: " . $this->duracion . "<br>"
                . "Área: " . $this->area . "<br>"
                . "Lugar: " . $this->lugar . "<br>"
                . "Horas dedicadas: " . $this->horas . " h<br>";
    }

    }