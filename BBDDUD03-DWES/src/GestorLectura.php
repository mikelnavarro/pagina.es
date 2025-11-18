<?php
namespace Mikel;
require_once '../tools/Conexion.php';
require "../vendor/autoload.php";

class GestorLectura implements AccionesBD {


    // Atributos
    private $conexion;
    function actualizar($id, array $datos){
        foreach($datos as $campo) {
            $titulo = $datos['titulo_libro'];
            $autor = $datos['autor'];
            $terminado = $datos['terminado'];
            $paginas = $datos['paginas'];
            $fecha = $datos['fecha_lectura'];
        // update datos
        $updt = "UPDATE lectura SET id = $id, titulo_lectura = $titulo, autor = $autor, paginas = $paginas, terminados = $terminado, fecha_lectura = $fecha
                WHERE id = $id";
            
        }
    }
    function listar(){
        
        
        $select = "SELECT id,titulo_lectura,autor,paginas,fecha_lectura FROM lectura";
        $arrayLibros = $conexion->query($select);
        
        return $arrayLibros;
    }
    function insertar(array $datos) {
        
        foreach($datos as $l){
            $titulo = $l['titulo_libro'];
            $autor = $l['autor'];
            $paginas = $l['paginas'];
            $fecha_lectura = $l['fecha_lectura'];
            $i = "INSERT INTO lectura(titulo_lectura,autor,paginas,fecha_lectura)
            VALUES ($titulo,$autor,$paginas,$fecha_lectura);";
        }
    }
    
    
}

?>