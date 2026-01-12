<?php
session_start();
namespace Mikelnavarro\Nacion;

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$user]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($pass, $usuario['password'])) {
        $_SESSION['user_id'] = $usuario['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nación PHP - Login</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2>Nación PHP</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="user" placeholder="Usuario" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <button type="submit">Entrar al Ministerio</button>
        </form>
    </div>
</body>

</html>