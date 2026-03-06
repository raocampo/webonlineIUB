<?php
/**
 * Genera comprobante de pago en PDF
 */

session_start();

// Verificar sesión activa
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit;
}

require_once 'conexion.php';
require_once 'security-helper.php';
require_once 'pdf-helper.php';

// Obtener ID del pago
$pagoId = $_GET['id'] ?? null;

if (!$pagoId) {
    die('ID de pago no especificado');
}

try {
    // Obtener datos del pago
    $stmt = $pdo->prepare("
        SELECT p.* 
        FROM pagos p
        WHERE p.id = ? AND p.usuario_id = ?
    ");
    $stmt->execute([$pagoId, $_SESSION['usuario_id']]);
    $pago = $stmt->fetch();
    
    if (!$pago) {
        die('Pago no encontrado');
    }

    // Obtener datos del usuario
    $stmt = $pdo->prepare("
        SELECT * FROM usuarios WHERE id = ?
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch();

    // Registrar actividad
    SecurityHelper::logActivity(
        $pdo, 
        $_SESSION['usuario_id'], 
        'download_payment_receipt', 
        "Descarga de comprobante de pago ID: {$pagoId}"
    );

    // Generar HTML del comprobante
    $html = PDFHelper::generarComprobantePago($pago, $usuario);
    
    // Generar nombre de archivo
    $filename = 'comprobante_pago_' . str_pad($pagoId, 8, '0', STR_PAD_LEFT) . '.pdf';
    
    // Enviar HTML (el usuario puede usar Ctrl+P o el botón de imprimir del navegador)
    echo $html;
    echo '<script>
        window.onload = function() {
            // Auto-abrir diálogo de impresión
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>';
    
} catch (PDOException $e) {
    error_log("Error en generar-comprobante.php: " . $e->getMessage());
    die('Error al generar el comprobante');
}
