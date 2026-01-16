<!-- ESQUELETO DE UNA WEBAPP MVC HECHA CON PHP CLÁSICO.
     Características:
       - Arquitectura MVC.
       - Modelo heredable y capa de abstracción de datos.
       - Controladores múltiples.
       - Capa de seguridad para control de sesiones.
-->
<?php

session_start();

include_once "../src/models/seguridad.php";

// Hacemos include de todos los controladores
foreach (glob("../src/controllers/*.php") as $file) {
    include $file;
}

// Miramos el valor de la variable $controller, si existe. Si no, le asignamos un controlador por defecto
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
} else {
    $controller = "UsuariosController";  // Controlador por defecto
}

// Miramos el valor de la variable $function, si existe. Si no, le asignamos una acción por defecto
if (isset($_REQUEST["function"])) {
    $function = $_REQUEST["function"];
} else {
    $function = "formLogin";  // Acción por defecto
}

// Creamos un objeto de tipo $controller y llamamos al método $function()
$c = new $controller();
$c->$function();