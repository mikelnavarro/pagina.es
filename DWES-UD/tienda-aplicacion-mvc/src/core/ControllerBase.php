<?php
// src/Core/ControllerBase.php
namespace Acme\IntranetRestaurante\Core;


abstract class ControllerBase
{
    protected function renderView($viewName, $data = [])
    {
        // Lógica para incluir la vista, pasarle los datos...
        extract($data);
        include __DIR__ . "/../../views/{$viewName}.php";
    }

    public function model($model)
    {
        $modelClass = "Acme\\IntranetRestaurante\\Models\\$model";
        return new $modelClass();
    }
    protected function redirect($url)
    {
        header("Location: {$url}");
        exit();
    }
}
