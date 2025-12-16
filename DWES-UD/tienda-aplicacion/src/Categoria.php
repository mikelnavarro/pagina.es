<?php

namespace src;

require "/../tools/Conexion.php";
class Categoria
{

    // Atributo
    private $codCat;
    private $nombreCat;
    private $descripcion;

    public function __construct($codCat, $nombreCat, $descripcion){
        $this->codCat = $codCat;
        $this->nombreCat = $nombreCat;
        $this->descripcion = $descripcion;
    }

}