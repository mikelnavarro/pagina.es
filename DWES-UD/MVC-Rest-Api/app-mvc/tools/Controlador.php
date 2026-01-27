<?php

namespace tools;

class Controlador
{
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