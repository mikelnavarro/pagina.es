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
    if ($visitas >= 10){
    setcookie("visitas", NULL, -1);
}
if (isset($_POST["seleccionar-idioma"])){
    $idioma = $_POST["seleccionar-idioma"];
    setcookie("seleccionar-idioma", $idioma, time() + 3600*24);



}

}


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($idioma=="castellano"){
    echo "Bienvenido por $visitas vez";
}else if ($idioma=="ingles"){
    echo "Welcome for $visitas";
}else if ($idioma=="frances"){
    echo "Bienvenide for $visitas";
}
}

// Borrado de cookies y variables
if (isset($_POST["borradoCookies"])){
    setcookie("visitas", NULL, -1);
    unset($visitas);
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
    <form action="contador_visitas copy.php" method=" post">
        <!-- Botones -->
        <input type="hidden" name="borradoCookies" value="si">
        <input type="submit" value="Borrar cookies"><br><br><br>
        <select id="seleccionar-idioma">
            <option value="ingles">Inglés</option>
            <option value="frances">Francés</option>
            <option value="castellano">Español</option>
        </select>
    </form>
</body>

</html>