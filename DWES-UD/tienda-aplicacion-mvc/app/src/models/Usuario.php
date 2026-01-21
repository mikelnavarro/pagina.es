<?php
// src/Usuario.php

namespace Mikelnavarro\TiendaAplicacion;

use Exception;
use MNL\tools\Conexion;
use PDO;

class Usuario
{
    private $codRes;
    private $correo;
    private $clave;
    private $cp;
    private $pais;
    private $ciudad;
    private $direccion;

    public function __construct($codRes, $correo, $clave, $cp, $pais, $ciudad, $direccion)
    {
        $this->codRes = $codRes;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->cp = $cp;
        $this->pais = $pais;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
    }
    public function __destruct()
    {

        unset($this->codRes, $this->correo, $this->clave, $this->cp, $this->pais, $this->ciudad, $this->direccion);
    }

    /**
     * Método toString
     */
    public function __toString()
    {
        return "Restaurante:  {$this->codRes}, Correo: {$this->correo}, Clave: {$this->clave}";
    }

    /** Listar
     * Usuarios
     */
    public static function buscarPorCorreo(string $correo): ?array
    {
        $pdo = Conexion::getConexion();

        $stmt = $pdo->prepare("SELECT * FROM restaurantes WHERE correo = ?");
        $stmt->execute([$correo]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar($pdo)
    {
        $pdo = Conexion::getConexion();
        $sql = "SELECT * FROM restaurantes";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public static function login($correo, $password)
    {
        try {
            $pdo = Conexion::getConexion();
            $sql = "SELECT CodRes, Correo, Clave FROM restaurantes WHERE Correo = :correo AND Clave = :password";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':correo' => $correo,
                ':password' => $password
            ]);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
    // Getters
    // Setters
    public function getCodRes()
    {
        return $this->codRes;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function getClave()
    {
        return $this->clave;
    }
    public function getCp()
    {
        return $this->cp;
    }
    public function getCiudad()
    {
        return $this->ciudad;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setCodRes($codRes)
    {
        $this->codRes = $codRes;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function setCp($cp)
    {
        $this->cp = $cp;
    }
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
}
