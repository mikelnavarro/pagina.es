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
		$sql = "SELECT user, pass FROM usuarios WHERE user = :user AND pass = :pass";
		if ($stmt = $this->conexion->prepare($sql)){
		$stmt->bindParam(":user",$username);
		$stmt->bindParam(":pass",$password);
			
		return $stmt->execute();
	}
	} catch(Exception $exception) {
		echo $exception->getMessage();
	}
	}
}