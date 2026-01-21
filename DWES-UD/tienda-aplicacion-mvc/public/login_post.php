<?php

require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Usuario;
// Usar LOGIN BÁSICO
session_start();
// Recibe datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $correo = $_POST["correo"] ?? null;
    $clave = $_POST["clave"] ?? null;
    try {
        // Intentar login
        Usuario::login($correo, $clave);
        $usu = Usuario::buscarPorCorreo($correo);
        if (!$usu) {
            header("Location: login.php?mensaje=Usuario no encontrado");
            exit();
        }

        // Guardamos el array completo en 'usuario'
        $_SESSION['usuario'] = $usu;
        $_SESSION['usu'] = [
            'CodRes'    => (int)$usu['CodRes'],
            'correo'    => $usu['Correo'],
            'password'  => $usu['Clave'],
            'pais'      => $usu['Pais'],
            'direccion' => $usu['Direccion']
        ];
        header('Location: index.php?mensaje=Logueado correctamente');
        exit();
    } catch (Exception $e) {
        header("Location: login.php?mensaje=" . urlencode($e->getMessage()));
        exit();
    }
}