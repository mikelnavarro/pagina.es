<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/iniciador.php';


// Parsear la ruta desde $_GET['path'] (gracias a .htaccess)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);


// Eliminar prefijo 'public' si se accede como /public/...
if (isset($parts[0]) && $parts[0] === 'public') {
    array_shift($parts);
}
// Rutas por defecto
$controllerName = 'RestauranteController';
$action = 'loginForm';
$id = null;
