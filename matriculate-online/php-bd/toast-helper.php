<?php
/**
 * Helper para generar notificaciones Toast desde PHP
 */

class ToastHelper {
    /**
     * Genera el script para mostrar un toast
     * @param string $message Mensaje a mostrar
     * @param string $type Tipo: success, error, warning, info
     * @param int $duration Duración en milisegundos
     * @return string Script HTML
     */
    public static function show($message, $type = 'info', $duration = 4000) {
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        return "
        <script>
            if (typeof toast !== 'undefined') {
                toast.{$type}('{$message}', {$duration});
            } else {
                alert('{$message}');
            }
        </script>
        ";
    }

    /**
     * Muestra un toast de éxito
     */
    public static function success($message, $duration = 4000) {
        return self::show($message, 'success', $duration);
    }

    /**
     * Muestra un toast de error
     */
    public static function error($message, $duration = 4000) {
        return self::show($message, 'error', $duration);
    }

    /**
     * Muestra un toast de advertencia
     */
    public static function warning($message, $duration = 4000) {
        return self::show($message, 'warning', $duration);
    }

    /**
     * Muestra un toast de información
     */
    public static function info($message, $duration = 4000) {
        return self::show($message, 'info', $duration);
    }

    /**
     * Redirecciona con toast
     * @param string $url URL de redirección
     * @param string $message Mensaje
     * @param string $type Tipo de toast
     * @param int $delay Delay antes de redirigir (ms)
     */
    public static function redirect($url, $message, $type = 'info', $delay = 1500) {
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        echo "
        <script>
            if (typeof toast !== 'undefined') {
                toast.{$type}('{$message}');
                setTimeout(function() {
                    window.location = '{$url}';
                }, {$delay});
            } else {
                alert('{$message}');
                window.location = '{$url}';
            }
        </script>
        ";
        exit;
    }
}
?>
