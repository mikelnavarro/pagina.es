
<?php
// Configuración de conexión a la base de datos
$host = "localhost"; // o "127.0.0.1"
$usuario = "root";  // Usuario por defecto en XAMPP
$clave = "";        // Contraseña por defecto en XAMPP (en blanco)
$base_de_datos = "loteriadecimos";

// Crear conexión
$conn = new mysqli($host, $usuario, $clave, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$provincia = $_POST['provincia'];
$correo = $_POST['correo'];
$numeroSerie = $_POST['numeroSerie'];
$decimo = $_POST['decimo'];
$codigoSeguridad = $_POST['codigoSeguridad'];

// Preparar la consulta SQL
$sql = "INSERT INTO participantes (nombre, apellidos, dni, provincia, correo, numero_serie, decimo, codigo_seguridad)
VALUES ('$nombre', '$apellidos', '$dni', '$provincia', '$correo', '$numeroSerie', '$decimo', '$codigoSeguridad')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido guardados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();


?>
