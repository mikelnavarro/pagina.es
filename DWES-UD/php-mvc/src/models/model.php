<?php

include_once "db.php";

// MODELO BASE DEL QUE HEREDAN EL RESTO DE MODELOS

class Model {

  protected $table;    // Aquí guardaremos el nombre de la tabla a la que estamos accediendo
  protected $key;      // Aquí guardaremos el nombre de la columna que contiene el id (por defecto, "id")
  protected $db;       // Y aquí la capa de abstracción de datos

  public function __construct()  {
    $this->db = new Db();
  }

  public function getAll() {
    $list = $this->db->dataQuery("SELECT * FROM ".$this->table);
    return $list;
  }

  public function get($id) {
    $record = $this->db->dataQuery("SELECT * FROM ".$this->table." WHERE ".$this->key."= $id");
    return $record;
  } 

  public function delete($id) {
    $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE ".$this->key." = $id");
    return $result;
  }
}