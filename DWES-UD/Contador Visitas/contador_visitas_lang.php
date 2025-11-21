<?php
//Crear textos multiidioma
// --- i18n básico ---
$TEXTOS = [
    'es' => ['titulo' => 'Formulario para cambio de idioma', 'guardar' => 'Guardar',],
    'en' => ['titulo' => 'Language change form',           'guardar' => 'Save',    ],
    'fr' => ['titulo' => 'Formulaire de changement de langue','guardar' => 'Enregistrer'],
    'de' => ['titulo' => 'Formular zur Sprachänderung',    'guardar' => 'Speichern'],
];

//Borrar Cookies & orden envíada vía GET
if (isset($_GET['borrar'])) {
    // Para borrar la cookie se le da una fecha de expiración pasada
    setcookie("visitas", "", time() - 3600, '/');
    setcookie('lang', "", time()-3600*24, '/');
    header('location: contador_visitas_lang.php');
    exit;
}

// Menejar el formulario con envío POST: selector "lang"
// Actualizar cooke "lang"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lang'])){
    $lang = $_POST['lang'];
    setcookie('lang', $lang, time()+3600*24, '/');
    header("location: contador_visitas_lang.php");
    exit;
}

//Crear Cookies
if (!isset($_COOKIE['lang'])){
    setcookie('lang', 'es', time() + 3600*24, '/');
    $lang = 'es';
}else{
    $lang = $_COOKIE['lang'];
}

if (!isset($_COOKIE['visitas'])) { // si no existe
    setcookie('visitas', '1', time() + 3600 * 24, '/');
    $mensajeBienvenida = "Bienvenido por primera vez";
} else { // si existe
    $visitas = (int) $_COOKIE['visitas'];
    $visitas++; // se reescribe incrementada
    setcookie('visitas', $visitas, time() + 3600 * 24, '/');
    $mensajeBienvenida = "Bienvenido por $visitas vez";
}

//Defino los textos según el idioma.
$titulo = $TEXTOS[$lang]['titulo'];
//Si el idioma seleccionado no tiene traducción asignada, le asigno el valor por defecto.
//operador ?? "si lo de la izquierda tiene valor y no es null lo uso, en caso contrario uso lo de la derecha"
$guardar = $TEXTOS[$lang]['guardar'] ?? $TEXTOS['es']['guardar'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo; ?></title>
</head>
<body>
    <h1> <?= htmlspecialchars($titulo) ?> </h1>
    <p><?php echo htmlspecialchars($mensajeBienvenida) ?> </p>
    <!-- Enlace para borrar la cookie -->
    <br><a href='contador_visitas_lang.php?borrar=1'>Borrar cookie</a>
    <form method="post">
        <select name="lang">
            <!-- Forma 1: ternario -->
            <option value= "es" <?php echo ($lang=="es")?"selected":""?>>ES</option>
            <option value= "en" <?php echo ($lang=="en")?"selected":""?>>EN</option>
            <!-- Forma 2: if compacto -->
            <option value= "fr" <?php if ($lang=="fr") echo "selected"; ?>>FR</option>
            <!-- Forma 3: sintaxis abreviada con -->
            <option value= "de" <?= ($lang=="de") ? "selected" : "" ?>>DE</option>
        </select>
        <button type="submit"><?= htmlspecialchars($guardar) ?></button>
    </form>
</body>
</html>