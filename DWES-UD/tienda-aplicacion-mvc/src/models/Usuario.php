<?php
// src/Usuario.php

namespace Acme\IntranetRestaurante\Models;

use MNL\tools\Db;
use Exception;

class Usuario
{
    private Db $db;
    private ?int $codRes;
    private ?string $correo;
    private ?string $clave;
    private $cp;
    private $pais;
    private $ciudad;
    private $direccion;

    public function __construct($codRes = null, $correo = null, $clave = null, $cp = null, $pais = null, $ciudad = null, $direccion = null, Db $db = null)
    {
        $this->db = $db ?? new Db();
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
    /**
     * Búsqueda estática por correo (compatibilidad).
     */
    public static function buscarPorCorreo(string $correo): ?array
    {
        $db = new Db();
        $db->query("SELECT * FROM restaurantes WHERE Correo = :correo");
        $db->bind(':correo', $correo);
        $row = $db->registro(); // objeto o false
        if ($row === false || $row === null) return null;
        return (array)$row;
    }



    public function listar(): array
    {
        $sql = "SELECT * FROM restaurantes";
        $this->db->query($sql);
        $rows = $this->db->registros();
        $result = [];
        foreach ($rows as $o) {
            $result[] = (array)$o;
        }
        return $result;
    }

    /**
     * Login estático: devuelve fila del usuario o null.
     */
    public static function login(string $correo, string $password): ?array
    {
        try {
            $db = new Db();
            $db->query("SELECT CodRes, Correo, Clave FROM restaurantes WHERE Correo = :correo AND Clave = :password");
            $db->bind(':correo', $correo);
            $db->bind(':password', $password);
            $row = $db->registro();
            if ($row === false || $row === null) return null;
            return (array)$row;
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * Login usando la conexión inyectada.
     */
    public function loginInstance(string $correo, string $password): ?array
    {
        try {
            $sql = "SELECT CodRes, Correo, Clave FROM restaurantes WHERE Correo = :correo AND Clave = :password";
            $this->db->query($sql);
            $this->db->bind(':correo', $correo);
            $this->db->bind(':password', $password);
            $row = $this->db->registro();
            if ($row === false || $row === null) return null;
            return (array)$row;
        } catch (Exception $exception) {
            return null;
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
