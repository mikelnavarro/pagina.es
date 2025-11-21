<?php
echo "Ruta dentro de htdocs: ". $_SERVER['PHP_SELF'];
echo "Nombre del servidor: ". $_SERVER['SERVER_NAME'];
echo "Software del servidor". $_SERVER['SERVER_SOFTWARE'];
echo "Protocolo: ". $_SERVER['SERVER_PROTOCOL'];
echo "Metodo de la peticion: ". $_SERVER['REQUEST_METHOD'];
?>