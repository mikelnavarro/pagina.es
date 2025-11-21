<?php
echo "Hola " . $_GET["nombre"];



if (empty($_GET["nombre"])) {
    echo "Eror, falta el parámetro nombre";
} else {
    echo "Hola " . $_GET["nombre"];
}
?>