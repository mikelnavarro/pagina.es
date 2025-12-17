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

    public function __construct($codCat, $nombreCat, $descripcion)
    {
        $this->codCat = $codCat;
        $this->nombreCat = $nombreCat;
        $this->descripcion = $descripcion;
    }


    /*
     *
     * Funciones
     */

    public function listar()
    {
        $pdo = Conexion::getConexion();
        $sql = "SELECT CodCat, Nombre, Descripcion FROM categorias ORDER BY Nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function todas(): array
    {
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare("SELECT CodCat, Nombre, Descripcion FROM categorias ORDER BY Nombre");
        $stmt->execute();
        $categorias = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $categorias[] = new self($row->CodCat, $row->Nombre, $row->Descripcion);
        }
        return $categorias;
    }


    public function getCodCat()
    {
        return $this->codCat;
    }
    public function getNombreCat()
    {
        return $this->nombreCat;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setCodCat($codCat)
    {
        $this->codCat = $codCat;
    }
    public function setNombreCat($nombreCat)
    {
        $this->nombreCat = $nombreCat;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}