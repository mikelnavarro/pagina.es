<?php
namespace Mikelnavarro\TiendaAplicacion;
use Mikelnavarro\TiendaAplicacion\Tools\Conexion;
use PDO;

class Producto {
    // Atributos
    
    private $codProd;
    private $nombre;
    private $descripcion;
    private $peso;
    private $stock;
    private $categoria;

    // Constructores
    public function __construct($codProd, $nombre, $descripcion, $peso, $stock, $categoria) {
        $this->codProd = $codProd;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->peso = $peso;
        $this->stock = $stock;
        $this->categoria = $categoria;
    }
    // Funciones
    // Acceder a la BD
    public function productosPorCategoria($categoria) {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE categoria = :categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["categoria" => $categoria]);
        return $stmt->fetch();

}

    public static function buscarPorId(int $codProd):Producto{
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE id = :codProd";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["codProd" => $codProd]);
        return $stmt->fetch();
    }
    public function getCodProd() {
        return $this->codProd;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getPeso() {
        return $this->peso;
    }
    public function getStock() {
        return $this->stock;
    }
    public function getCategoria() {
        return $this->categoria;
    }
    public function setCodProd($codProd) {
        $this->codProd = $codProd;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function setPeso($peso) {
        $this->peso = $peso;
    }
    public function setStock($stock) {
        $this->stock = $stock;
    }
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    
}