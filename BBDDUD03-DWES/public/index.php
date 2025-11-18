<?php
?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Login</title>
    <meta charset="utf-8">
</head>

<body>
    <?php  if(isset($_GET["redirigido"])){
        echo "<p>Haga Login para continuar.</p>";
    }?>
    <form action="comprobar_user.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario">
        <label for="clave">Clave:</label>
        <input type="text" id="clave" name="clave">
        <input type="submit">
    </form>
</body>

</html>