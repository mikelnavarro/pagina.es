<?php

require "../vendor/autoload.php";
require_once '../Conexion.php';
class GestorMascotas
{

	private $conexion;
	public function __construct()
	{
		$this->conexion = (new Conexion())->conexion;
	}

	// Funciones


	public function getID($id)
	{

		try {
			$sql = "SELECT id, nombre, tipo, fecha_nacimiento, foto_url, id_persona FROM mascotas";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam("id", $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}
	public function modificar($datos)
	{
		$sql = "UPDATE mascotas SET nombre=:nombre,tipo=:tipo,fecha_nacimiento=:fecha_nacimiento,foto_url=:foto_url,id_persona=:id_persona WHERE id=:id";
		$stmt = $this->conexion->prepare($sql);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		if ($stmt->execute(array(
			":nombre" => $datos["nombre"],
			":tipo" => $datos["tipo"],
			":fecha_nacimiento" => $datos["fecha_nacimiento"],
			":foto_url" => $datos["foto_url"],
			":id_persona" => $datos["id_persona"]
		)));
	}

	public function responsable($responsable)
	{

		try {

			$sql = "SELECT id FROM personas WHERE nombre=:nombre";
			$stmt = $this->conexion->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $exception) {
			echo $exception->getMessage();
		}
	}
	public function listar()
	{
		$sql = "SELECT id, nombre, tipo, fecha_nacimiento, foto_url, id_persona FROM mascotas";
		$stmt = $this->conexion->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public function eliminar($id)
	{
		$sql = "DELETE FROM mascotas WHERE id = :id";
		$stmt = $this->conexion->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		return $stmt->execute() . $this->conexion->prepare("ALTER TABLE mascotas AUTO_INCREMENT = 1")->execute();
	}

	public function registrar(array $datos)
	{
		try {
			$sql = "INSERT INTO mascotas (nombre,tipo,fecha_nacimiento,foto_url,id_persona) VALUES
    	(:nombre, :tipo, :fecha_nac, :foto_url, :id_persona)";
			$stmt = $this->conexion->prepare($sql);
			return $stmt->execute(array(
				":nombre" => $datos["nombre"],
				":tipo" => $datos["tipo"],
				":fecha_nac" => $datos["fecha_nac"],
				":foto_url" => $datos["foto_url"],
				":id_persona" => $datos["id_persona"]
			));
		} catch (Exception $exception) {
			echo $exception->getMessage();
		}
	}
}
