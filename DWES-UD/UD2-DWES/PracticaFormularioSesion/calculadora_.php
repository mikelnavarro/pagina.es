<?php
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
            echo "$numero1 + $numero2: " . number_format($resultado, 3, ',', '.');
            break;
        case 'Resta':
            $resultado = restar($numero1, $numero2);
            echo "$numero1 menos $numero2: " . number_format($resultado, 3, ',', '.');
            break;
        case 'Multiplicacion':
            $resultado = multiplicar($numero1, $numero2);
            echo "$numero1 X $numero2: " . number_format($resultado, 3, ',', '.');
            break;
        case 'Division':
            $resultado = dividir($numero1, $numero2);
            $resto = $numero1 % $numero2;
            echo "$numero1 entre $numero2: " . number_format($resultado, 3, ',', '.') . " y el resto: " . $resto;
            break;
        default:
            # code...
            break;
    }
}
echo "<hr>";
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