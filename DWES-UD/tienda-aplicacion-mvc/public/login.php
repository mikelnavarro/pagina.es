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
    * {
        font-family: "Arial";
    }

    /* --- VARIABLES DE COLOR (Tema Mascotas) --- */
    :root {
        --color-primario: #4caf50;
        --color-secundario: #ffd700;
        --color-fondo: #f0f4f8;
        --color-texto: #333;
        --color-sombra: rgba(0, 0, 0, 0.15);
    }

    /* --- ESTILOS GENERALES Y FONDO --- */
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: "Arial", sans-serif;
        align-items: center;
        min-height: 100vh;
        color: var(--color-texto);
    }

    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        gap: 10px;
        padding: 20px;
        border: 1px solid #ccc;
        justify-content: center;

    }

    label {
        padding: 0;
        font-weight: bold;
        margin: 0;
        align-items: left;
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="email"],
    input[type="password"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 12px 15px;
        width: calc(100% - 30px);
        margin-top: 5px;
        height: auto;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: var(--color-secundario);
        box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        outline: none;
    }

    button {
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

        background-color: #007bff;
        color: white;
        cursor: pointer;
        margin-top: 20px;
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

        <a href="index.php">Página Principal</a>
        <div id="loginContainer">
            <h1>Acceder</h1>
            <?php if (!empty($_GET['error'])): ?>
            <p style="color:red;">Credenciales incorrectas</p>
            <?php endif; ?>
            <form action="login_post.php" method="post">
                <label>Email: <input type="email" name="correo" required></label><br>
                <label>Contraseña: <input type="password" name="password" required></label><br>
                <button id="enviarDatos" type="submit">Entrar</button>
            </form>
</body>

</html>