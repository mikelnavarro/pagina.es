<?php
// Formulario Login habitual
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["usuario"])) {
    $usu = comprobar_usuario($_POST["usuario"],$_POST["clave"]);
        }    
    if ($usu==FALSE){
        $err = TRUE;
        $usuario = $_POST["usuario"];
    }else{
        session_start();
        $_SESSION["usuario"] = $_POST["usuario"];
        
        header("Location:calculos.php");
    }
}

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
?>
<?php if (isset($err) && $err == true ){
    header("Location:error.php");
}?>