<?php

//Configuración acceso a base de datos
define('DB_HOST', 'localhost'); //tu servidor de BD.
define('DB_USUARIO', 'cesar');
define('DB_PASSWORD', 'cesar');
define('DB_NOMBRE', 'test'); // Tu base de datos



//Ruta de la aplicación. /app o /src
define('RUTA_APP', (dirname(__DIR__)));

//Ruta url Ejemplo: http://localhost/ud5/mvc2app
//define ('RUTA_URL', '_URL_');
define ('RUTA_URL', 'http://localhost/ud6/mvccomposerapicar');

//define ('NOMBRESITIO', '_NOMBRE_SITIO');
define ('NOMBRESITIO', 'MVC con Composer');

// Cargar archivo INI si es necesario.
//$config = parse_ini_file(RUTA_APP . '/config/config.ini', true);

// Otras configuraciones iniciales pueden ir aquí