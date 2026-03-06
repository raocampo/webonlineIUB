<?php
/**
 * Conexión a la base de datos usando PDO
 * Configuración basada en variables de entorno para mayor seguridad
 */

// Cargar variables de entorno
require_once __DIR__ . '/env-loader.php';

// Credenciales de la base de datos desde variables de entorno
$host = EnvLoader::get('DB_HOST', 'localhost');
$db = EnvLoader::get('DB_NAME', 'webonline');
$user = EnvLoader::get('DB_USER', 'root');
$pass = EnvLoader::get('DB_PASS', '');
$charset = EnvLoader::get('DB_CHARSET', 'utf8mb4');

// DSN (Data Source Name) para PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_PERSISTENT => false, // Evitar conexiones persistentes por seguridad
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // En producción, no mostrar detalles del error
    if (EnvLoader::get('APP_ENV') === 'production') {
        error_log("Error de conexión a BD: " . $e->getMessage());
        die("Error de conexión a la base de datos. Contacte al administrador.");
    } else {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
}
?>