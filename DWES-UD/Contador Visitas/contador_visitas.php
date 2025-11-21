<?php
/*
<?php
// Si se envian datos desde el formulario de actores
if(isset($_POST["actriz"])){
    $actriz = $_POST["actriz"];
    $actor = $_POST["actor"];
    setcookie("actriz", $actriz, time() + 3*24*3600);
    setcookie("actor", $actor, time() + 3*24*3600);
} else if (isset($_COOKIE["actriz"])) {
    $actriz = $_COOKIE["actriz"];
    $actor = $_COOKIE["actor"];
}

*/
if (!isset($_COOKIE["visitas"])) {
    setcookie("visitas", 1, time() + 3600 * 24);
    echo "Bienvenido por primera vez";
} else { // si existe
    $visitas = (int) $_COOKIE["visitas"];
    $visitas++; // se reescribe incrementada
    setcookie("visitas", $visitas, time() + 3600 * 24);
    echo "Bienvenido por $visitas vez";
}
if ($visitas >= 10){
    setcookie("visitas", NULL, -1);
}



// Borrado
/* if (isset($_POST["borradoCookies"])){
    setcookie("visitas", NULL, -1);
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <hr>
    <form action="#" method="post">
        <input type="hidden" name="borradoCookies" value="si">
        <input type="submit" value="Borrar cookies"><br><br><br>
    </form>
</body>

</html>