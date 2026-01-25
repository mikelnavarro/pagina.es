<?php

namespace MikelNavarro\TiendaAplicacion\Models;

use MNL\tools\Conexion;
use PDO;

class Categoria
{

    // Atributo
    private $codCat;
    private $nombreCat;
    private $descripcion;

    public function __construct() {}


    /*
     *
     * Funciones
     * 
     */

    public function listar()
    {
        $pdo = Conexion::getConexion();
        $sql = "SELECT CodCat, Nombre, Descripcion FROM categorias ORDER BY Nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Obtiene productos de una categoría específica.
    */
    public function getProductosPorCategoria(int $categoriaId): array
    {
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare("
            SELECT id, nombre, precio, stock 
            FROM producto 
            WHERE categoria_id = :categoria_id 
            ORDER BY nombre
        ");
        $stmt->bindParam(':categoria_id', $categoriaId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    /**
     * Obtiene todas las categorías.
     */
    public function getTodas(): array
    {
        $pdo = Conexion::getConexion();
        $stmt = $pdo->prepare("SELECT id, nombre FROM categoria ORDER BY nombre");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    // Getters y Setters

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
