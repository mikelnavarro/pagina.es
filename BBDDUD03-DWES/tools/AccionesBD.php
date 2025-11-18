<?php


interface AccionesBD {
    
    function listar(): array;
    function eliminar($id, array $datos);
    function actualizar(int $id, array $datos);
    function insertar(array $datos);
}

?>