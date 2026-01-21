<?php
namespace Mikelnavarro\TiendaAplicacion;
use MNL\tools\Conexion;
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
    // Acceder a la BD
    public static function productosPorCategoria($categoria) {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE categoria = :categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["categoria" => $categoria]);
        return $stmt->fetchAll();

}

    public static function buscarPorId(int $codProd) {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM productos WHERE codProd = :codProd";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["codProd" => $codProd]);
        // Devolver una sola fila (producto) en lugar de un array de filas.
        // add_carrito.php espera un array asociativo con las columnas.
        return $stmt->fetch(PDO::FETCH_ASSOC);
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