<?php

// Cargar el autoload de COMPOSER
require 'vendor/autoload.php';


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/libs/Db.php';
require_once __DIR__ . '/libs/Controlador.php';
require_once __DIR__ . '/libs/Core.php';



//Autoload php
spl_autoload_register(function($nombreClase){
    require_once __DIR__.'/app/libs/'.$nombreClase.'.php';
});