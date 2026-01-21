<?php

namespace Mikelnavarro\TiendaAplicacion;

use MNL\tools\Conexion;

class Pedido
{

    // Atributos
    private $codPedido;
    private $fecha;
    private $enviado;
    private $restaurante;

    public function __construct($codPedido, $fecha, $enviado, $restaurante) {
        $this->codPedido = $codPedido;
        $this->fecha = $fecha;
        $this->enviado = $enviado;
        $this->restaurante = $restaurante;
    }

    // Base de Datos
    // Funciones

    // Listar Pedidos
    public function listar():array {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM pedido WHERE codPedido = :codPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["codPedido"] => $this->codPedido);
        return $stmt->fetchAll();
    }


    // Getters y Setters
    public function getCodPedido() {
        return $this->codPedido;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getEnviado() {
        return $this->enviado;
    }

}