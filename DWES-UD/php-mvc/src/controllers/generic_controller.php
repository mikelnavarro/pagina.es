<?php

// CONTROLADOR DE ...
include_once("../models/generic_model.php");  // Modelos
include_once("view.php");              // Plantilla de vistas

class GenericController
{
    private $db;             // Conexión con la base de datos
    private $model_name;     // Modelo

    public function __construct()
    {
        $this->model = new GenericModel();
    }

    // --------------------------------- MOSTRAR TODOS ----------------------------------------
    public function show()
    {
    }

    // --------------------------------- FORMULARIO INSERCIÓN ----------------------------------------

    public function formInsert()
    {
    }

    // --------------------------------- INSERCIÓN ----------------------------------------

    public function insert()
    {
    }

    // --------------------------------- BORRADO ----------------------------------------

    public function delete()
    {
    }

    // --------------------------------- FORMULARIO ACTUALIZACIÓN ----------------------------------------

    public function formUpdate()
    {
    }

    // --------------------------------- MODIFICACIÓN ----------------------------------------

    public function update()
    {
    }

    // --------------------------------- BÚSQUEDA ----------------------------------------

    public function search()
    {
    }


} // class