<?php
require "../vendor/autoload.php";
require "../src/Usuario.php";
$user = new Usuario();
$lUsuarios = $user->listaUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php foreach($lUsuarios as $u):?>
            <div><?= $u["username"] ?></div>
        <?php endforeach;?>


    </main>
</body>
</html>