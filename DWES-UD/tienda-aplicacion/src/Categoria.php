<?php

namespace Mikelnavarro\TiendaAplicacion;

use Mikelnavarro\TiendaAplicacion\Tools\Conexion;
use PDO;

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


    /*
     *
     * Funciones
     */

    public static function todas():array {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM categorias";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $categorias = [];

        while ($row = $pdo->fetch(PDO::FETCH_OBJ)) {
            $categorias[] = new Categoria($row->codCat, $row->nombreCat, $row->descripcion);
        }
        return $categorias;
    }
    public function getCodCat(){
        return $this->codCat;
    }
    public function getNombreCat(){
        return $this->nombreCat;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setCodCat($codCat){
        $this->codCat = $codCat;
    }
    public function setNombreCat($nombreCat){
        $this->nombreCat = $nombreCat;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }



}