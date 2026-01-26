<?php

// Este archivo es la "puerta" de la aplicación. TODAS las peticiones pasan por aquí.



// A continuación se cargan las dependencias y se decide qué controlador/action ejecutar.
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../iniciador.php';

// --- 1) LEER LA URL QUE PIDE EL NAVEGADOR
// Nombre simple: $requestUri contiene la parte de la URL que indica la página.
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Determinar base (carpeta donde está el script) para proyectos en subdirectorio
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$scriptDir = rtrim($scriptDir, '/');

// Eliminar el prefijo del script (si existe) para obtener la ruta relativa
if ($scriptDir !== '' && strpos($requestUri, $scriptDir) === 0) {
    $path = trim(substr($requestUri, strlen($scriptDir)), '/');
} else {
    $path = trim($requestUri, '/');
}

// --- 3) Valores por defecto
$controllerName = 'RestauranteController'; // controlador por defecto
$action = 'loginForm'; // acción por defecto
$params = [];

// Aquí ponemos rutas que siempre deben ir a un controlador/acción concretos.
$routes = [
    '' => ['controller' => 'RestauranteController', 'action' => 'loginForm'],
    'Paginas/login' => ['controller' => 'RestauranteController', 'action' => 'loginForm'],
    'Restaurante/login' => ['controller' => 'RestauranteController', 'action' => 'login'],
    'Categoria/categorias' => ['controller' => 'CategoriaController', 'action' => 'categorias'],
    'Categoria/listar' => ['controller' => 'CategoriaController', 'action' => 'listar'],
    'Carrito/listar' => ['controller' => 'CarritoController', 'action' => 'listar'],
    'Carrito/agregar' => ['controller' => 'CarritoController', 'action' => 'agregar'],
    'Carrito/actualizar' => ['controller' => 'CarritoController', 'action' => 'actualizar'],
    'Pedido/crear' => ['controller' => 'PedidoController', 'action' => 'crear'],
    'Restaurante/logout' => ['controller' => 'RestauranteController', 'action' => 'logout'],
];

// --- 5) Comprobar si la ruta coincide con una ruta conocida
if (isset($routes[$path])) {
    $controllerName = $routes[$path]['controller'];
    $action = $routes[$path]['action'];
} else {
    // Si no está en $routes, intentamos entender la URL de forma genérica:
    $segments = array_values(array_filter(explode('/', $path)));

    // Eliminar prefijos que no son controladores (carpetas, dominios, nombres con guiones, números...)
    // Esto evita que algo como 'DWES-UD' o 'tienda-aplicacion-mvc' se tome como controlador.
    while (!empty($segments) && (
        strpos($segments[0], '.') !== false ||
        $segments[0] === 'public' ||
        // si el segmento contiene caracteres distintos a letras A-Z (p. ej. '-', números)
        !preg_match('/^[A-Za-z]+$/', $segments[0])
    )) {
        array_shift($segments);
    }

    // Primer segmento -> nombre del controlador (normalizamos a TitleCase)
    if (!empty($segments)) {
        $controllerName = ucfirst(strtolower(array_shift($segments))) . 'Controller';
    }

    // Segundo segmento -> acción (método). Normalizamos a minúsculas.
    if (!empty($segments)) {
        $action = strtolower(array_shift($segments));
    }

    // El resto son parámetros que se pasarán al método
    $params = $segments;
}