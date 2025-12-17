<?php
// Importar la clase Conexion.php
require "../vendor/autoload.php";
require "Conexion.php";
class Usuario
{

    private $conexion;
    public function __construct()
    {
        $this->conexion = (new Conexion())->conexion;
    }

    // FUNCIONES
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
    public function listaUsuarios() {
        try {

            $sql = "SELECT username FROM usuarios";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
    public function comprobarUsuario($username, $password)
    {
        try {

            $sql = "SELECT username, password FROM usuarios WHERE username = :username";
            if ($stmt = $this->conexion->prepare($sql)) {
                $stmt->bindParam(":username", $username);
                $stmt->execute();

                // 2. Obtiene el hash almacenado de la base de datos
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Si se encuentra el usuario, $enc_password contiene el hash de la BD
                $enc_password = $row['password']; //
                // 3. ¡La comprobación clave! Compara la contraseña (texto plano) con el hash (BD)
                if (password_verify($password, $enc_password)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getID($id)
    {
        $sql = "SELECT id FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function deleteUsername($id)
    {
        try {

            $sql = "DELETE FROM usuarios WHERE id = :id";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getUsername($usuario)
    {
        $sql = "SELECT id, username, password FROM usuarios WHERE username = :usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        return $stmt->fetch();
    }
}