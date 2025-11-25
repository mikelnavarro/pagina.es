<?php

require 'Conexion.php';


/*

Las transacciones siguen siempre estos pasos:

** beginTransaction() **
Desactiva el auto-commit. Lo que hagas después no se guarda todavía.

Ejecutas tus operaciones SQL
(consultas, inserciones, actualizaciones, borrados...)

Si todo ha ido bien → ** commit() **
Se guardan definitivamente los cambios.

Si ocurre un error → ** rollBack() **
Revierte todo a como estaba antes de empezar.
Supongamos una clase Libro con métodos: listar(), insertar(), modificar(), borrar().

El método modificar() podría usar transacciones así:
*/
public function modificar(array $datos) {
    try {
        $this->conexion->beginTransaction();

        $sql = "UPDATE libros SET titulo = :titulo, autor = :autor,
                n_paginas = :n_paginas, fecha_publicacion = :fecha_publicacion,
                terminado = :terminado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($datos);

        $this->conexion->commit();
        return true;

    } catch (Exception $e) {
        $this->conexion->rollBack();
        return false;
    }
}


?>