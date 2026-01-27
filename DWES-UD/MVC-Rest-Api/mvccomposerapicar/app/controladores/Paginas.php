<?php
namespace Cls\Mvc2app;

use Cls\Mvc2app\Controlador;

    class Paginas extends Controlador{

        public function __construct(){
            $this->articuloModelo = $this->modelo('articulo');
        }

        public function index(){

            $datos = [
                'titulo' => NOMBRESITIO,
            ];

            $this->vista('paginas/inicio', $datos);    
        }

        public function articulos(){
            $this->vista('paginas/articulo');
        }

        public function ejemplo(){

            $articulos = $this->articuloModelo->obtenerArticulos();
            $datos = [
                'titulo' => NOMBRESITIO,
                'articulos' => $articulos
            ];

            $this->vista('paginas/ejemplo-inicio', $datos);
        }

        public function contacto(){

            $this->vista('paginas/contacto', ['titulo' => 'Página de Contacto']);
        }

    }