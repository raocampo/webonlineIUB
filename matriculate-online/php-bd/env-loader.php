<?php
/**
 * Cargador de variables de entorno
 * Carga el archivo .env y las hace disponibles en $_ENV
 */

class EnvLoader {
    public static function load($path) {
        if (!file_exists($path)) {
            throw new Exception("El archivo .env no existe en: {$path}");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parsear línea
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                // Remover comillas si existen
                $value = trim($value, '"\'');

                // Establecer variable de entorno
                if (!array_key_exists($name, $_ENV)) {
                    $_ENV[$name] = $value;
                    putenv("{$name}={$value}");
                }
            }
        }
    }

    public static function get($key, $default = null) {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
}

// Cargar archivo .env automáticamente
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    EnvLoader::load($envPath);
}
?>
