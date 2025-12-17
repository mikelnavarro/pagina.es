<?php
$config_file = 'config.ini';

// 1. Leer el archivo INI y convertirlo en un array asociativo de PHP
if (file_exists($config_file)) {
    // La función parse_ini_file() devuelve un array con los datos agrupados por sección
    $config = parse_ini_file($config_file, true); 
} else {
    die("Error: El archivo de configuración $config_file no fue encontrado.");
}

// Verificar si la sección 'database' existe
if (isset($config['database'])) {
    $db_params = $config['database'];

    // 2. Construir el DSN (Data Source Name) para PDO
    // Este ejemplo es para MySQL
    $dsn = "mysql:host={$db_params['host']};port={$db_params['port']};dbname={$db_params['database']};charset=utf8mb4";
    $username = $db_params['username'];
    $password = $db_params['password'];

    // 3. Usar PDO para conectar
    try {
        $pdo = new PDO($dsn, $username, $password);
        
        // Configurar PDO para que lance excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Conexión a la base de datos exitosa.";

        // Aquí puedes continuar con tus consultas SQL usando $pdo->query() o $pdo->prepare()

    } catch (PDOException $e) {
        // Manejar errores de conexión
        die("Error de conexión PDO: " . $e->getMessage());
    }
} else {
    die("Error: La sección [database] no se encontró en el archivo config.ini.");
}
?>
