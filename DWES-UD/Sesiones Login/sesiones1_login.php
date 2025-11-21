<?php
// Formulario Login habitual

function comprobar_usuario($nombre, $clave){
    
    if($nombre === "usuario" && $clave === "1234"){
        $usu["nombre"] = "usuario";
        $usu["rol"] = 0;
        return $usu;
    }elseif($nombre === "admin" && $clave === "1234"){
        $usu["nombre"] = "admin";
        $usu["rol"] = 1;
        return $usu;
    }else return FALSE;
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $usu = comprobar_usuario($_POST["usuario"],$_POST["clave"]);
    
    if ($usu==FALSE){
        $err = TRUE;
        $usuario = $_POST["usuario"];
    }else{
        session_start();
        
        $_SESSION["usuario"] = $_POST["usuario"];
        
        header("Location:sesiones1_principal.php");
    }
}
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

    <?php if (isset($err) && $err == true ){
        echo "<p>Revise usuario y contraseña.</p>";
    }?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php if(isset($usuario)) echo $usuario;?>">
        <label for="clave">Clave:</label>
        <input type="text" id="clave" name="clave">
        <input type="submit">
    </form>
</body>

</html>