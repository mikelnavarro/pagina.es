<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["resultado"])) {
        $resultado = $_GET["resultado"];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
</head>

<body>
    <?php
    if (isset($resultado)) {
        echo "Resultado actual: " . $resultado . "<br>";
    }

    ?>
    <form action="resolucion.php" id="calculadora-form" method="POST">

        <label name="numero1">Número 1: </label>
        <input type="number" name="numero1"><br><br>
        <label name="numero1">Número 2: </label>
        <input type="number" name="numero2"><br><br>


        <select name="operacion" max="4" required>
            <option value="Suma"> Suma </option>
            <option value="Resta"> Resta </option>
            <option value="Division"> División </option>
            <option value="Multiplicacion"> Multiplicacion </option>
        </select><br>
        <input id="submit" type="submit" value="calcular"><br><br>
        <input name="resultado" value="<?php echo $resultado ?>">
    </form>
</body>

</html>
<?php
if (!isset($_SESSION["contador"])) {
    $_SESSION["contador"] = 0;
    $_SESSION["sumatorio"] = 0;
}

// Si hay un resultado nuevo, lo añadimos al sumatorio
if (isset($resultado)) {
    $_SESSION["contador"]++;
    $_SESSION["sumatorio"] += $resultado;
        if ($_SESSION["contador"] >= 5) {
        // Comprobamos si el sumatorio es mayor o igual a 1000
        if ($_SESSION["sumatorio"] >= 1000) {
            $_SESSION["contador"] = 0;
            $_SESSION["sumatorio"] = 0;
            header("Location: ecuacion.php");
        } else {
            // Si no llega a 1000, reiniciamos para empezar de nuevo
            $_SESSION["contador"] = 0;
            $_SESSION["sumatorio"] = 0;
        }
    }
}
    echo "Operaciones realizadas: " . $_SESSION["contador"] . " de 5<br>";
    echo "Sumatorio actual: " . $_SESSION["sumatorio"] . "<br>";
?>