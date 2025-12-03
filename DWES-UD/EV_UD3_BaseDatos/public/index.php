<?php
// Importar Login
require '../vendor/autoload.php';
require '../src/Usuario.php';
// Usar LOGIN BÁSICO
$usuario = new Usuario();
// Recibe datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? null;
    $clave = $_POST["clave"] ?? null;

    // Solo si existe username
    if ($username && $clave) {
        $usu = $usuario->comprobarUsuario($username, $clave);
    } else {
        $usu = false;
    }

    // Comprobamos en el caso que sea falso
    if ($usu == FALSE) {
        $err = TRUE;
        $username = $_POST["username"];
    } else {
        session_start();
        $_SESSION["usuario"] = $_POST["username"];
        header("Location: principal.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="estilosForm.css">
</head>

<body>
    <main>
        <?php
        if (isset($_GET["redirigido"])) {
            echo "<p>Haga Login para continuar.</p>";
        }
        ?>
        <?php
        if (isset($err) && $err == true) {
            echo "<p>Revise usuario y contraseña.</p>";
        }
        ?>
        <div id="loginContainer">
            <h3>Bienvenido</h3>
            <form id="formLogin" action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username">
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave">
                <input type="submit" value="Iniciar Sesión" id="enviarDatos">
            </form>
            <a href="registrarse.php" id="botonRegistrarse">¿No
                tienes cuenta? Regístrate aquí
        </div>
    </main>
</body>

</html>