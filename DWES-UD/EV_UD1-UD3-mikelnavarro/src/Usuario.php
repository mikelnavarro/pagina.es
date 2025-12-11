<?php
require "Conexion.php";
class Usuarios {


    private $conexion;

    // Constructor
	public function __construct(){
		$this->conexion = (new Conexion())->conexion;
    }
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