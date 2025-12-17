<?php
// Importar Login
require '../vendor/autoload.php';
require '../src/Login.php';
// Usar LOGIN BÁSICO
$login = new Login();
// Recibe datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"])) {
        $usu = $login->comprobarUsuario($_POST["username"], $_POST["clave"]);
    }

    // Comprobamos en el caso que sea falso
    if ($usu == FALSE) {
        $err = TRUE;
        $username = $_POST["username"];
    } else {
        session_start();
        $_SESSION["usuario"] = $_POST["username"];
        header("Location: principalCopy.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php if (isset($_GET["redirigido"])) {
        echo "<p>Haga Login para continuar.</p>";
    }

    ?><?php if (isset($err) && $err == true) {
            echo "<p>Revise usuario y contraseña.</p>";
        }

        ?>

    <div class="loginContainer">
        <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username">
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave"><input type="submit">
        </form>

    </div>
</body>

</html>