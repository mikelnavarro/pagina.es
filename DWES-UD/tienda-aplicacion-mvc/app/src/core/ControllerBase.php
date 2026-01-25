<?php
// src/Core/ControllerBase.php
namespace MikelNavarro\TiendaAplicacion\Core;


abstract class ControllerBase {
    protected function renderView($viewName, $data = []) {
        // Lógica para incluir la vista, pasarle los datos...
        extract($data);
        include __DIR__ . "/../../views/{$viewName}.php";
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit();
    }
}