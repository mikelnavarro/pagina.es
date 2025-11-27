<?php
// Importar la clase Conexion.php
require "vendor/autoload.php";
require 'Conexion.php';
class Login {

	private $conexion;

	// Constructor

	public function __construct(){
		$this->conexion = (new Conexion())->conexion;
	}



	// Base de datos
	public function comprobarUsuario($username,$password){
	try {
		$sql = "SELECT username, password FROM usuarios WHERE username = :username AND password = :password";
		if ($stmt = $this->conexion->prepare($sql)){
		$stmt->bindParam(":username",$username);
		$stmt->bindParam(":password",$password);
			
		return $stmt->execute();

	}
	} catch(Exception $exception) {
		echo $exception->getMessage();
	}
	}
}
/* COMPROBAR USUARIO LOGIN
function comprobarUsuario($nombre,$clave){

	if ($nombre==="usuario" && $clave==="1234"){
		$usu["nombre"] = "usuario";
        $usu["rol"] = 0;
        return $usu;
	} else if ($nombre==="admin" && $clave==="1234"){
		$usu["nombre"] = "admin";
		$usu["rol"] = 1;
		return $usu;
	} else {
		return FALSE;
	}
}

*/
?>
