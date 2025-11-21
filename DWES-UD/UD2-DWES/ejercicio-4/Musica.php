<?php
include_once 'Ayuda.php';
include_once 'Acciones.php';
include_once 'Hobby.php';
include_once 'Lectura.php';
include_once 'ContadorTiempo.php';




$canciones = ["Cancion A", "Cancion B", "Cancion C"];
$artistas = ["Artista", "Lucía", "Luis"];
$albums = ["Album A", "Album B", "album"];
$areas = ["Ocio"];
$lugares = ["Parque", "Casa de un amig@", "Casa",];

// Instanciar un objeto de música
echo "<h1>Música es clase anónima</h1>";



$Musica = new class(
    Ayuda::generarElementoAleatorio($canciones),
    Ayuda::generarElementoAleatorio($artistas),
    Ayuda::generarElementoAleatorio($albums),
    Ayuda::generarDecimalAleatorio(2, 6),
    Ayuda::generarElementoAleatorio($areas),
    Ayuda::generarElementoAleatorio($lugares),
    Ayuda::generarEntero(0, 5)

) extends Hobby implements Acciones {
    use ContadorTiempo;
	// Atributos
	private $cancion;
    private $artista;
	private $album;
	private $duracion;

	// Constructor
	public function __construct($cancion, $artista, $album, $duracion, $area, $lugar, $horas) {
        parent::__construct($area, $lugar, $horas); // Constructor Padre
		$this->cancion = $cancion;
        $this->artista = $artista;
		$this->album = $album;
		$this->duracion = $duracion;
	}

	    // Modificadores

    public function getCancion() {
        return $this->cancion;
    }
    public function getArtista() {
        return $this->artista;
    }
    public function getAlbum() {
    	return $this->album;
    }
    public function getDuracion() {
        return $this->duracion;
    }
    public function setCancion($cancion) {
        $this->cancion = $cancion;
    }
    public function setArtista($artista) {
        $this->artista = $artista;
    }
    public function setAlbum($album) {
    	$this->album = $album;
    }
    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }





    // Métodos
    public function __toString() {
        return "Cancion: " . $this->cancion . "<br>"
            . "Artistas: " . $this->artista . "<br>"
            . "Duracion: " . $this->duracion . "<br>"
            . "Álbum: " . $this->album . "<br>"
            . "Lugar: " . $this->lugar . "<br>"
            . "Area: " . $this->area . "<br>"
            . "Horas Dedicadas: " . $this->horas . "<br>";
     }


    
    // Implementación de métodos abstractos de la clase Hobby
    public function compartoCon() {
        return "El hobby de escuchar música se comparte con audífonos o con amigos.";
    }
    public function practicarHobby() {
        return "Practicar musica consisten en escuchar o tocar instrumentos.";
    }
    

    // Implemetar metodos de la interfaz Acciones
    public function realizarAccion() {
        return "Escuchando la cancion " . $this->cancion . " del álbum " . $this->album . " de " . $this->artista . "<br>";
    }
    public function detenerAccion() {
        return "Pausando la cancion " . $this->cancion . " de " . $this->artista . "<br>";
    }


};

// Usar el objeto de la clase anónima
echo $Musica;
echo "<hr>";
echo $Musica->realizarAccion();
echo "<br>";

// Usar los métodos del trait
$Musica->setTiempoMinimo(1);
$Musica->setTiempoMaximo(4);
if ($Musica->tiempoValido()) {
    echo "El tiempo dedicado es válido (entre " . $Musica->getTiempoMinimo() . " y " . $Musica->getTiempoMaximo() . " horas).";
} else {
    echo "El tiempo dedicado no es válido.";
}
?>