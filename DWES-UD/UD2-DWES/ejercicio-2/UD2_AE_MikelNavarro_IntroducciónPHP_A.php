<?php
$numero = 5;
echo "$numero<br>";


function esPrimo ($numero) {
    if ($numero <= 1) {
        return false;
    } else if ($numero == 2) {
        return false;
    }
    for($i = 2; $i < $numero; $i++) {
        $divisor = $numero % $i;
        if ($divisor == 0) {
            return false;
        }


    }
    return true;
}



    if (esPrimo($numero)) {
        echo "es primo";
    } else {
        echo "no es primo";
    }
echo "<br>";
$numAnterior = $numero - 1;
echo "$numAnterior<br>";
    if (esPrimo($numAnterior)) {
        echo "es primo";
    } else {
        echo "no es primo";
    }