<?php

namespace MikelNavarro\TiendaAplicacion\Controllers;
use MikelNavarro\TiendaAplicacion\Models\Categoria;
use MikelNavarro\TiendaAplicacion\Core\ControllerBase;

class CategoriaController extends ControllerBase
{

    /**
     * Muestra la lista de todas las categorías.
     */
    public function categorias()
    {
        $modelo = new Categoria();
        $categorias = $modelo->getTodas();
        $this->renderView('categoria/categorias', ['categorias' => $categorias]);
    }

    /**
     * Muestra los productos de una categoría específica.
     *
    * @param int $id ID de la categoría
    */
    public function listar(int $id)
    {
        $modelo = new Categoria();
        $productos = $modelo->getProductosPorCategoria($id);
        $this->renderView('categoria/listar', [
            'productos' => $productos,
            'categoriaId' => $id
        ]);
    }
}
