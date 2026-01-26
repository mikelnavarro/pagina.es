<?php

// --- 6) Crear el controlador y llamar la acción
// Los controladores están en el namespace Acme\IntranetRestaurante\Controllers
$fullControllerClass = "Acme\\IntranetRestaurante\\Controllers\\$controllerName";

// Comprobamos si la clase existe (para evitar errores)
if (class_exists($fullControllerClass)) {
    // Instanciamos el controlador
    $controller = new $fullControllerClass();

    // Comprobamos si la acción (método) existe en esa clase
    if (method_exists($controller, $action)) {
        // Finalmente llamamos al método y le pasamos los parámetros que vengan en la URL.
        // Ejemplo: Categoria/listar/5 -> $action = 'listar', $params = ['5']
        call_user_func_array([$controller, $action], $params);
    } else {
        // Acción no encontrada -> 404
        http_response_code(404);
        echo "Acción '$action' no encontrada en el controlador.";
    }
} else {
    http_response_code(404);
    echo "Controlador '$controllerName' no encontrado.";
}