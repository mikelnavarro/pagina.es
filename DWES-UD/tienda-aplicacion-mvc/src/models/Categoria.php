<?php

namespace Acme\IntranetRestaurante\Models;
use MNL\tools\Db;

class Categoria
{
    private Db $db;
    private $codCat;
    private $nombreCat;
    private $descripcion;

    public function __construct()
    {
        $this->db = new Db();
    }

    /*
     * Funciones
     */

    public function listar(): array
    {
        $sql = "SELECT CodCat AS id, Nombre AS nombre, Descripcion FROM categorias ORDER BY Nombre";
        $this->db->query($sql);
        $rows = $this->db->registros(); // devuelve objetos
        $result = [];
        foreach ($rows as $o) {
            $result[] = (array)$o;
        }
        return $result;
    }

    /**
     * Obtiene productos de una categoría específica.
     */
    public function getProductosPorCategoria(int $categoriaId): array
    {
        $sql = "SELECT CodProd AS id, Nombre AS nombre, Precio AS precio, Stock AS stock FROM productos WHERE Categoria = :categoria_id ORDER BY Nombre";
        $this->db->query($sql);
        $this->db->bind(':categoria_id', $categoriaId);
        $rows = $this->db->registros();
        $result = [];
        foreach ($rows as $o) {
            $result[] = (array)$o;
        }
        return $result;
    }

    /**
     * Obtiene todas las categorías.
     */
    public function getTodas(): array
    {
        $sql = "SELECT CodCat AS id, Nombre AS nombre FROM categorias ORDER BY Nombre";
        $this->db->query($sql);
        $rows = $this->db->registros();
        $result = [];
        foreach ($rows as $o) {
            $result[] = (array)$o;
        }
        return $result;
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
