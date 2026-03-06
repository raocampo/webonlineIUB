<?php
/**
 * Procesa upload de foto de perfil
 */

session_start();

// Verificar sesión activa
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => 'unauthorized',
        'message' => 'No autorizado. Inicie sesión.'
    ]);
    exit;
}

require_once 'conexion.php';
require_once 'security-helper.php';
require_once 'upload-helper.php';

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'method_not_allowed',
        'message' => 'Método no permitido.'
    ]);
    exit;
}

// Verificar CSRF token
if (!SecurityHelper::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'error' => 'csrf_invalid',
        'message' => 'Token de seguridad inválido.'
    ]);
    exit;
}

// Verificar que se envió un archivo
if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
    echo json_encode([
        'success' => false,
        'error' => 'no_file',
        'message' => 'No se seleccionó ningún archivo.'
    ]);
    exit;
}

$userId = $_SESSION['usuario_id'];

try {
    // Validar y subir archivo
    $result = UploadHelper::uploadFile(
        $_FILES['file'],
        'profile',
        'image',
        $userId,
        'profile_'
    );

    if (!$result['success']) {
        echo json_encode($result);
        exit;
    }

    // Obtener foto anterior del usuario
    $stmt = $pdo->prepare("SELECT foto_perfil FROM usuarios WHERE id = ?");
    $stmt->execute([$userId]);
    $usuario = $stmt->fetch();

    // Eliminar foto anterior si existe
    if ($usuario && $usuario['foto_perfil']) {
        $oldFilename = basename($usuario['foto_perfil']);
        UploadHelper::deleteFile('profile', $oldFilename);
    }

    // Actualizar base de datos
    $stmt = $pdo->prepare("UPDATE usuarios SET foto_perfil = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$result['url'], $userId]);

    // Registrar actividad
    SecurityHelper::logActivity($pdo, $userId, 'profile_photo_updated', 'Foto de perfil actualizada');

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Foto de perfil actualizada correctamente.',
        'filename' => $result['filename'],
        'url' => $result['url']
    ]);

} catch (PDOException $e) {
    error_log("Error en upload-profile-photo.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'database_error',
        'message' => 'Error al actualizar la foto de perfil.'
    ]);
}
