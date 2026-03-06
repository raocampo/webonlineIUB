<?php
/**
 * Utilidades de seguridad
 * Funciones para prevenir XSS, CSRF y otras vulnerabilidades
 */

class SecurityHelper {
    
    /**
     * Sanitiza una cadena para prevenir XSS
     * @param string $string Cadena a sanitizar
     * @return string Cadena sanitizada
     */
    public static function sanitize($string) {
        if ($string === null) {
            return '';
        }
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Alias de sanitize para salidas HTML
     */
    public static function esc($string) {
        return self::sanitize($string);
    }

    /**
     * Genera un token CSRF
     * @return string Token CSRF
     */
    public static function generateCsrfToken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }

    /**
     * Verifica un token CSRF
     * @param string $token Token a verificar
     * @return bool True si es válido
     */
    public static function verifyCsrfToken($token) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Genera un campo oculto con token CSRF
     * @return string HTML del campo oculto
     */
    public static function csrfField() {
        $token = self::generateCsrfToken();
        $tokenName = EnvLoader::get('CSRF_TOKEN_NAME', 'csrf_token');
        return '<input type="hidden" name="' . $tokenName . '" value="' . $token . '">';
    }

    /**
     * Limpia datos de entrada
     * @param mixed $data Datos a limpiar
     * @return mixed Datos limpios
     */
    public static function cleanInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'cleanInput'], $data);
        }
        
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    /**
     * Valida un email
     * @param string $email Email a validar
     * @return bool True si es válido
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Valida que una cadena solo contenga caracteres alfanuméricos
     * @param string $string Cadena a validar
     * @return bool True si es válida
     */
    public static function isAlphanumeric($string) {
        return ctype_alnum($string);
    }

    /**
     * Registra un intento de login fallido
     * @param string $usuario Usuario que intentó loguearse
     * @param PDO $pdo Conexión a la base de datos
     */
    public static function registerFailedLogin($usuario, $pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET login_attempts = login_attempts + 1 WHERE usuario = ?");
            $stmt->execute([$usuario]);
            
            // Bloquear cuenta si hay más de 5 intentos fallidos
            $stmt = $pdo->prepare("SELECT login_attempts FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $result = $stmt->fetch();
            
            if ($result && $result['login_attempts'] >= 5) {
                $lockedUntil = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                $stmt = $pdo->prepare("UPDATE usuarios SET locked_until = ? WHERE usuario = ?");
                $stmt->execute([$lockedUntil, $usuario]);
            }
        } catch (PDOException $e) {
            error_log("Error registrando intento fallido: " . $e->getMessage());
        }
    }

    /**
     * Verifica si una cuenta está bloqueada
     * @param string $usuario Usuario a verificar
     * @param PDO $pdo Conexión a la base de datos
     * @return bool True si está bloqueada
     */
    public static function isAccountLocked($usuario, $pdo) {
        try {
            $stmt = $pdo->prepare("SELECT locked_until FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $result = $stmt->fetch();
            
            if ($result && $result['locked_until']) {
                if (strtotime($result['locked_until']) > time()) {
                    return true;
                } else {
                    // Desbloquear y resetear intentos
                    $stmt = $pdo->prepare("UPDATE usuarios SET locked_until = NULL, login_attempts = 0 WHERE usuario = ?");
                    $stmt->execute([$usuario]);
                }
            }
        } catch (PDOException $e) {
            error_log("Error verificando bloqueo: " . $e->getMessage());
        }
        
        return false;
    }

    /**
     * Resetea los intentos de login tras un login exitoso
     * @param string $usuario Usuario
     * @param PDO $pdo Conexión a la base de datos
     */
    public static function resetLoginAttempts($usuario, $pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET login_attempts = 0, locked_until = NULL, last_login = NOW() WHERE usuario = ?");
            $stmt->execute([$usuario]);
        } catch (PDOException $e) {
            error_log("Error reseteando intentos: " . $e->getMessage());
        }
    }

    /**
     * Registra actividad del usuario
     * @param string $usuario Usuario
     * @param string $action Acción realizada
     * @param string $description Descripción
     * @param PDO $pdo Conexión a la base de datos
     */
    public static function logActivity($usuario, $action, $description, $pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO activity_logs (usuario, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $usuario,
                $action,
                $description,
                $_SERVER['REMOTE_ADDR'] ?? null,
                $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
        } catch (PDOException $e) {
            error_log("Error registrando actividad: " . $e->getMessage());
        }
    }
}

// Función global de ayuda para sanitización rápida
function esc($string) {
    return SecurityHelper::sanitize($string);
}
?>
