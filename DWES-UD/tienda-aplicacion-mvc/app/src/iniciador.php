<?php
// Cargar el autoload de COMPOSER
require_once __DIR__ . '/../vendor/autoload.php';
// Incluye la conexión a la base de datos y la configuración
require_once __DIR__ . '/../app/config/Config.php';
require_once __DIR__ . '/../app/config/Database.php';

require_once __DIR__ . '/../app/core/ControllerBase.php';




/* Autoload php
spl_autoload_register(function($nombreClase){
    require_once __DIR__.'/app/libs/'.$nombreClase.'.php';
});

*/