<?php

// MODELO GENÉRICO (ADAPTAR A CADA MODELO CONCRETO)

include_once "model.php";

class GenericModel extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos y el identificador del campo clave
    public function __construct()
    {
        $this->table = "nombre_tabla";
        $this->key = "id";
        parent::__construct();
    }

    // Inserta un registro. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($campo1, $campo2, $campo3, $campoN)
    {
        return $this->db->dataManipulation("INSERT INTO libros (campo1, campo2, campo3, campoN) VALUES ('$campo1','$campo2', '$campo3', '$campoN')");
    }

    // Actualiza un registrop. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $campo1, $campo2, $campo3, $campoN)
    {
        $ok = $this->db->query("UPDATE libros SET
                                campo1 = '$campo1',
                                campo2 = '$campo2',
                                campo3 = '$campo3',
                                campoN = '$campoN',
                                WHERE ".$this->key." = '$id'");
        return $ok;
    }

    // Busca un textoen la tabla. Devuelve un array de objetos con todos los registros
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos los registros que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM ".$this->table.
					                   "WHERE campo1 LIKE '%$textoBusqueda%'
					                    OR campo2 LIKE '%$textoBusqueda%'
					                    OR campo3 LIKE '%$textoBusqueda%'
					                    OR campoN LIKE '%$textoBusqueda%'");
        return $result;
    }
}
