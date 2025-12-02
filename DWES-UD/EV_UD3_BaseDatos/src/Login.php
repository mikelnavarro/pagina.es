<?php
// Importar la clase Conexion.php
require "../vendor/autoload.php";
require "Conexion.php";
class Login
{

	private $conexion;
	

	// Constructor

	public function __construct()
	{
        $this->conexion = (new Conexion())->conexion;

	}



	// Base de datos
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
}
