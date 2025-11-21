<?php

session_start();
$_SESSION = array();

if (isset($_POST["borradoSesiones"])){
session_destroy();
setcookie(session_name(), 123, time() - 1000);

}
if (isset($_POST["redireccion"])){
    header("Location:calculos.php");
}


    if (isset($_POST["a"],$_POST["b"],$_POST["c"])){
        if (!empty($_POST["a"]) && !empty($_POST["b"]) && !empty($_POST["c"])){
            
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
           }
    


    // (-b+-raiz(b*b-4*a*c))/(2*a)
    $ecuacionSegundoGrado = ($b - sqrt($b * $b - 4 * $a * $c))/(2 * $a);  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        if (!empty($_POST["a"]) && !empty($_POST["b"]) && !empty($_POST["c"])){

    if (isset($ecuacionSegundoGrado)){
        echo $ecuacionSegundoGrado;
    }
        }
?>
    <form action="#" method="post">
        <input type="hidden" name="borradoSesiones" value="si">
        <input type="submit" value="Borrar Sesión"><br><br>
        <input type="submit" value="Calculadora Anterior" name="redireccion"><br><br>

    </form>
    <form action="#" method="POST">

        <label for="a">Coeficiente -a:</label>
        <input type="number" name="a"><br><br>
        <label for="b">Coeficiente -b:</label>
        <input type="number" name="b"><br><br>
        <label for="c">Coeficiente -c:</label>
        <input type="number" name="c"><br><br>

        <input type="submit" value="Resolver Ecuación">
        <input type=" text" name="SegundoGrado" value="<?php echo $ecuacionSegundoGrado?>" disabled=disabled>
    </form>
</body>

</html>