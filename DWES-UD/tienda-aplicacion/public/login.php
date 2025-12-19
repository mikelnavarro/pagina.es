<?php

require __DIR__ . '/../vendor/autoload.php';
use Mikelnavarro\TiendaAplicacion;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="estilosForm.css">
    <style>
        /* Estilos básicos para que el formulario se vea ordenado */
        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            gap: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }

        #clave {
            padding: 12px 15px;
            width: calc(100% - 30px);
            margin-top: 5px;
            height: auto;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
    </style>
</head>

<body>
    <main>
        <?php
        if (isset($_GET["redirigido"])) {
            echo "<p>Haga Login para continuar.</p>";
        }
        ?>
        <?php session_start(); ?>
        <?php
        if (isset($err) && $err == true) {
            echo "<p>Revise usuario y contraseña.</p>";
        }
        ?>
        <div id="loginContainer">
            <h1>Acceder</h1>
            <?php if (!empty($_GET['error'])): ?>
                <p style="color:red;">Credenciales incorrectas</p>
            <?php endif; ?>
            <form action="login_post.php" method="post">
                <label>Email: <input type="email" name="correo" required></label><br>
                <label>Contraseña: <input type="password" name="password" required></label><br>
                <button type="submit">Entrar</button>
            </form>
</body>

</html>