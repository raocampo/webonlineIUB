<?php
session_start();
require_once 'conexion.php';
require_once 'security-helper.php';

// Redirigir con mensaje de error (sin usar alert)
function redirectWithError(string $message): never {
    $_SESSION['login_error'] = $message;
    header('Location: /matriculate-online.php');
    exit;
}

// Limpiar datos de entrada
$usuario = SecurityHelper::cleanInput($_POST['usuario'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

// Validación básica
if (empty($usuario) || empty($contrasena)) {
    redirectWithError('Por favor complete todos los campos.');
}

try {
    // Verificar si la cuenta está bloqueada
    if (SecurityHelper::isAccountLocked($usuario, $pdo)) {
        redirectWithError('Su cuenta ha sido bloqueada temporalmente por múltiples intentos fallidos. Intente nuevamente en 30 minutos.');
    }

    // Buscar usuario
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($contrasena, $row['contrasena'])) {
        // Login exitoso
        SecurityHelper::resetLoginAttempts($usuario, $pdo);

        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['tipo'] = $row['tipo'];
        $_SESSION['login_time'] = time();

        session_regenerate_id(true);

        SecurityHelper::logActivity($usuario, 'login', 'Inicio de sesión exitoso', $pdo);

        if ($row['tipo'] === 'A') {
            header('Location: ../administrador/inicio-admin.php');
        } else {
            header('Location: ../inicio_matriculate.php');
        }
        exit;
    } else {
        // Credenciales incorrectas
        if ($row) {
            SecurityHelper::registerFailedLogin($usuario, $pdo);
            SecurityHelper::logActivity($usuario, 'login_failed', 'Contraseña incorrecta', $pdo);
        } else {
            SecurityHelper::logActivity(null, 'login_failed', "Intento con usuario inexistente: {$usuario}", $pdo);
        }
        redirectWithError('Usuario o contraseña incorrectos. Verifique sus datos.');
    }
} catch (PDOException $e) {
    error_log('Error en login: ' . $e->getMessage());
    redirectWithError('Error del sistema. Por favor intente más tarde.');
}
?>
