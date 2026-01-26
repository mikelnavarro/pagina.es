<?php

namespace Acme\IntranetRestaurante\Controllers;
use Acme\IntranetRestaurante\Models\Categoria;
use Acme\IntranetRestaurante\Core\ControllerBase;
use PDO;


class CategoriaController extends ControllerBase
{
    private Categoria $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    /**
     * Muestra la lista de todas las categorías.
     */
    public function categorias()
    {
        $categorias = $this->categoriaModel->getTodas();
        $this->renderView('categoria/categorias', ['categorias' => $categorias]);
    }

    /**
     * Muestra los productos de una categoría específica.
     *
    * @param int $id ID de la categoría
    */
    public function listar(int $id)
    {
        $productos = $this->categoriaModel->getProductosPorCategoria($id);
        $this->renderView('categoria/listar', [
            'productos' => $productos,
            'categoriaId' => $id
        ]);
    }
}
