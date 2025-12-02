<?php

require_once "../src/Conexion.php";
class Registro
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->conexion;
    }

    // Registrarse

    public function registrarUsuario($username, $password)
    {
        try {
            $enc_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (username,password) VALUES (:username, :password)";
            if ($stmt = $this->conexion->prepare($sql)) {
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $enc_password);

                return $stmt->execute();
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
    
    public function getUsername($usuario){
        $sql = "SELECT id, username, password FROM usuarios WHERE username = :usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":usuario",$usuario);
        $stmt->execute();
        return $stmt->fetch();
    }
}
