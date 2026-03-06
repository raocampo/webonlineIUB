<?php
/**
 * Procesa upload de documentos del usuario
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
$documentType = $_POST['document_type'] ?? 'general';
$documentName = $_POST['document_name'] ?? 'Documento';

// Determinar categoría y tipo de validación
$category = 'documents';
$validationType = 'document';

if ($documentType === 'cedula') {
    $category = 'cedula';
    $validationType = 'cedula';
}

try {
    // Validar y subir archivo
    $result = UploadHelper::uploadFile(
        $_FILES['file'],
        $category,
        $validationType,
        $userId,
        $documentType . '_'
    );

    if (!$result['success']) {
        echo json_encode($result);
        exit;
    }

    // Guardar información del documento en BD
    $stmt = $pdo->prepare("
        INSERT INTO documentos_usuario 
        (usuario_id, tipo_documento, nombre_documento, archivo_url, tamanio_bytes, estado, created_at) 
        VALUES (?, ?, ?, ?, ?, 'pendiente', NOW())
    ");
    
    $fileSize = $_FILES['file']['size'];
    $stmt->execute([
        $userId,
        $documentType,
        SecurityHelper::sanitize($documentName),
        $result['url'],
        $fileSize
    ]);

    $documentId = $pdo->lastInsertId();

    // Registrar actividad
    SecurityHelper::logActivity(
        $pdo, 
        $userId, 
        'document_uploaded', 
        "Documento subido: {$documentType} - {$documentName}"
    );

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Documento subido correctamente.',
        'document' => [
            'id' => $documentId,
            'filename' => $result['filename'],
            'url' => $result['url'],
            'type' => $documentType,
            'name' => $documentName,
            'size' => $fileSize
        ]
    ]);

} catch (PDOException $e) {
    error_log("Error en upload-document.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'database_error',
        'message' => 'Error al guardar el documento.'
    ]);
}
