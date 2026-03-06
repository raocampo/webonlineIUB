<?php
/**
 * Genera certificado de matrícula en PDF
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

try {
    // Obtener datos del usuario
    $stmt = $pdo->prepare("
        SELECT * FROM usuarios WHERE id = ?
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        die('Usuario no encontrado');
    }

    // Obtener datos de la carrera (si existe tabla de carreras)
    // Por ahora usaremos datos de ejemplo
    $carrera = [
        'nombre' => 'Tecnología Superior en Administración de Empresas',
        'modalidad' => 'Online',
        'nivel' => 'Tecnológico Superior'
    ];

    // Registrar actividad
    SecurityHelper::logActivity(
        $pdo, 
        $_SESSION['usuario_id'], 
        'download_enrollment_certificate', 
        "Descarga de certificado de matrícula"
    );

    // Generar HTML del certificado
    $html = PDFHelper::generarCertificadoMatricula($usuario, $carrera);
    
    // Generar nombre de archivo
    $filename = 'certificado_matricula_' . $usuario['identificacion'] . '.pdf';
    
    // Enviar HTML (el usuario puede usar Ctrl+P para guardar como PDF)
    echo $html;
    echo '<script>
        window.onload = function() {
            // Auto-abrir diálogo de impresión
            setTimeout(function() {
                window.print();
            }, 500);
        };
        
        // Agregar botón de descarga
        document.body.insertAdjacentHTML("beforeend", `
            <div class="no-print" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
                <button onclick="window.print()" style="
                    background: #1D327B;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 8px;
                    cursor: pointer;
                    font-size: 14px;
                    font-weight: bold;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                ">
                    <i class="fas fa-download"></i> Descargar PDF
                </button>
            </div>
        `);
    </script>';
    
} catch (PDOException $e) {
    error_log("Error en generar-certificado.php: " . $e->getMessage());
    die('Error al generar el certificado');
}
