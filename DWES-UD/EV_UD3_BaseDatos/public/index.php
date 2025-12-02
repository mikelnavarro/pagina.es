<?php
// Importar Login
require '../vendor/autoload.php';
require "../src/Login.php";
// Usar LOGIN BÁSICO
$login = new Login();
// Recibe datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? null;
    $clave = $_POST["clave"] ?? null;

    // Solo si existe username
    if ($username && $clave) {
        $usu = $login->comprobarUsuario($username, $clave);
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
    <style>
        :root {
            --color-primario: #1f4eddff;
            --color-secundario: #FFD700;
            --color-fondo: #F0F4F8;
            --color-texto: #333;
            --color-sombra: rgba(0, 0, 0, 0.15);
        }

        /* --- ESTILOS GENERALES Y FONDO --- */
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--color-fondo);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--color-texto);
            flex-direction: column;
        }
        #loginContainer {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 400px;
            width: 90%;
            margin-top: 80px;
            text-align: center;
        }

        #loginContainer h2 {
            color: var(--color-primario);
            margin-bottom: 25px;
            font-size: 2em;
            border-bottom: 2px solid var(--color-secundario);
            padding-bottom: 10px;
        }
        #formLogin {
            display: flex;
            flex-direction: column;
            gap: 1.5em;
            padding: 0;
            align-items: center;
            margin: 0;
            width: 100%;
            box-shadow: none;
        }

        label {
            width: 100%;
            text-align: left;
            font-weight: bold;
        }

        label #username,
        #clave {
            padding: 0;
            font-weight: bold;
            margin: 0;
            align-items: left;
        }

        #formLogin input[type="text"],
        #formLogin input[type="password"] {
            padding: 12px 15px;
            width: calc(100% - 30px);
            margin-top: 5px;
            height: auto;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        #formLogin input[type="text"]:focus,
        #formLogin input[type="password"]:focus {
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
            outline: none;
        }

        /* Botón de ENVIAR DATOS (Login) */
        #enviarDatos {
            padding: 15px 30px;
            border-radius: 50px;
            border-style: none;
            color: white;
            background-color: var(--color-primario);
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;
            margin-top: 10px;
        }

        #enviarDatos:hover {
            background-color: #388E3C;
            transform: translateY(-2px);
        }

        /* ---
OTRAS FUNCIONALIDADES
---
*/
        #botonRegistrarse {
            background: none;
            border: none;
            color: var(--color-texto);
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.9em;
            margin-top: 15px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        #botonRegistrarse:hover {
            opacity: 1;
            color: var(--color-primario);
        }
    </style>
</head>

<body>
    <?php if (isset($_GET["redirigido"])) {
        echo "<p>Haga Login para continuar.</p>";
    }
    ?>
    <?php if (isset($err) && $err == true) {
        echo "<p>Revise usuario y contraseña.</p>";
    }
    ?>
    <div id="loginContainer">
        <h2>Bievenido</h2>
        <form id="formLogin" action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username">
            <label for="clave">Clave:</label>
            <input type="text" id="clave" name="clave">
            <input type="submit" value="Iniciar Sesión" id="enviarDatos">
        </form>
        <a href="registrarse.php" id="botonRegistrarse">¿No tienes cuenta? Regístrate aquí
    </div>
</body>

</html>