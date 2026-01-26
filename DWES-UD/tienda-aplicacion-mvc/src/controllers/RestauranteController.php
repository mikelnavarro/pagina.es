<?php

namespace Acme\IntranetRestaurante\Controllers;

use Acme\IntranetRestaurante\Models\Categoria;
use Acme\IntranetRestaurante\Core\ControllerBase;

class RestauranteController extends ControllerBase
{
    /**
     * Acción por defecto: redirige a la lista de categorías.
     */
    public function index()
    {
        $this->redirect('Categoria/categorias');
    }

    /**
     * Muestra el formulario de login (se implementará después).
     */
    public function loginForm()
    {
        // Por ahora, también redirigimos a categorías
        $this->redirect('Categoria/categorias');
    }

    /**
     * Procesa el login (se implementará después).
     */
    public function login()
    {
        // Por ahora, redirigimos a categorías
        $this->redirect('Categoria/categorias');
    }

    /**
     * Cierra la sesión (se implementará después).
     */
    public function logout()
    {
        session_destroy();
        $this->redirect('Restaurante/loginForm');
    }
}
