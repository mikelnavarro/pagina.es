<?php
session_start();

if (!isset($_SESSION["contador"])) {
    $_SESSION["contador"] = 1;
} else {
    $_SESSION["contador"]++;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["numero1"],$_POST["numero2"],$_POST["operacion"])) {
        echo "<hr>";
$numero1 = $_POST["numero1"];
$numero2 = $_POST["numero2"];
$operacion = $_POST["operacion"];
}
if (empty($numero1) && empty($numero2)){
    echo "Error. Un o dos parámetros están vacios." . "<br>";
} else {

    switch ($operacion) {
        case 'Suma':
            $resultado = sumar($numero1, $numero2);
            break;
        case 'Resta':
            $resultado = restar($numero1, $numero2);
            break;
        case 'Multiplicacion':
            $resultado = multiplicar($numero1, $numero2);
            break;
        case 'Division':
            $resultado = dividir($numero1, $numero2);
            $resto = $numero1 % $numero2;
            break;
        default:
            # code...
            break;
    }
    header("Location: calculos.php");
}
}


function sumar($a, $b){
return $a + $b;
}
function restar($a, $b){
return $a - $b;
}
function multiplicar($a, $b){
return $a * $b;
}
function dividir($a, $b){
return $a / $b;
}

?>
<?php
$url = 'calculos.php?resultado=' . urlencode($resultado);
header('Location: ' . $url);
?>