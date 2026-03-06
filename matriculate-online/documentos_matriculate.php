<?php
/**
 * Página de Documentos del Usuario
 * Permite subir y gestionar documentos para matrícula
 */

session_start();

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit;
}

$pageTitle = "Mis Documentos";
require_once 'components/header.php';
require_once 'php-bd/conexion.php';

// Obtener documentos del usuario
try {
    $stmt = $pdo->prepare("
        SELECT d.*, td.nombre AS tipo_nombre, td.descripcion AS tipo_descripcion
        FROM documentos_usuario d
        LEFT JOIN tipos_documento td ON d.tipo_documento = td.codigo
        WHERE d.usuario_id = ?
        ORDER BY d.created_at DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $documentos = $stmt->fetchAll();
    
    // Obtener tipos de documentos disponibles
    $stmt = $pdo->query("
        SELECT * FROM tipos_documento 
        WHERE activo = TRUE 
        ORDER BY orden
    ");
    $tiposDocumentos = $stmt->fetchAll();
    
} catch (PDOException $e) {
    error_log("Error en documentos_matriculate.php: " . $e->getMessage());
    $documentos = [];
    $tiposDocumentos = [];
}
?>

<?php require_once 'components/nav.php'; ?>

<div class="content">
    <div class="page-header">
        <h1><i class="fas fa-file-upload"></i> Mis Documentos</h1>
        <p class="page-description">
            Sube los documentos requeridos para completar tu proceso de matrícula.
            Los archivos serán revisados por el área administrativa.
        </p>
    </div>

    <!-- Resumen de documentos -->
    <div class="documents-summary">
        <div class="summary-card">
            <div class="summary-icon" style="background-color: rgba(13, 110, 253, 0.1);">
                <i class="fas fa-file" style="color: var(--link-color);"></i>
            </div>
            <div class="summary-info">
                <h3><?php echo count($documentos); ?></h3>
                <p>Total Documentos</p>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon" style="background-color: rgba(255, 193, 7, 0.1);">
                <i class="fas fa-clock" style="color: var(--warning);"></i>
            </div>
            <div class="summary-info">
                <h3><?php echo count(array_filter($documentos, fn($d) => $d['estado'] === 'pendiente')); ?></h3>
                <p>Pendientes Revisión</p>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon" style="background-color: rgba(25, 135, 84, 0.1);">
                <i class="fas fa-check-circle" style="color: var(--success);"></i>
            </div>
            <div class="summary-info">
                <h3><?php echo count(array_filter($documentos, fn($d) => $d['estado'] === 'aprobado')); ?></h3>
                <p>Aprobados</p>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon" style="background-color: rgba(220, 53, 69, 0.1);">
                <i class="fas fa-times-circle" style="color: var(--danger);"></i>
            </div>
            <div class="summary-info">
                <h3><?php echo count(array_filter($documentos, fn($d) => $d['estado'] === 'rechazado')); ?></h3>
                <p>Rechazados</p>
            </div>
        </div>
    </div>

    <!-- Sección de subida de documentos -->
    <div class="section-card">
        <h2><i class="fas fa-upload"></i> Subir Nuevo Documento</h2>
        
        <form id="uploadDocumentForm" class="upload-form">
            <?php echo SecurityHelper::csrfField(); ?>
            
            <div class="form-group">
                <label for="documentType">Tipo de Documento *</label>
                <select id="documentType" name="document_type" required class="form-control">
                    <option value="">Seleccione un tipo de documento</option>
                    <?php foreach ($tiposDocumentos as $tipo): ?>
                        <option value="<?php echo esc($tipo['codigo']); ?>" 
                                data-descripcion="<?php echo esc($tipo['descripcion']); ?>">
                            <?php echo esc($tipo['nombre']); ?>
                            <?php echo $tipo['obligatorio'] ? '(Obligatorio)' : '(Opcional)'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text" id="documentTypeHelp"></small>
            </div>
            
            <div class="form-group">
                <label for="documentName">Nombre del Documento (Opcional)</label>
                <input type="text" 
                       id="documentName" 
                       name="document_name" 
                       class="form-control"
                       placeholder="Ej: Cédula actualizada 2024">
            </div>
            
            <div id="uploadZone"></div>
            
            <button type="submit" class="btn-primary" id="uploadBtn" disabled>
                <i class="fas fa-cloud-upload-alt"></i> Subir Documento
            </button>
        </form>
    </div>

    <!-- Lista de documentos subidos -->
    <div class="section-card">
        <h2><i class="fas fa-folder-open"></i> Documentos Subidos</h2>
        
        <?php if (empty($documentos)): ?>
            <div class="empty-state">
                <i class="fas fa-file-invoice"></i>
                <p>Aún no has subido ningún documento</p>
                <small>Sube los documentos requeridos para completar tu matrícula</small>
            </div>
        <?php else: ?>
            <div class="documents-list">
                <?php foreach ($documentos as $doc): ?>
                    <div class="document-item">
                        <div class="document-icon">
                            <?php
                            $extension = pathinfo($doc['archivo_url'], PATHINFO_EXTENSION);
                            $iconClass = match(strtolower($extension)) {
                                'pdf' => 'fa-file-pdf',
                                'doc', 'docx' => 'fa-file-word',
                                'jpg', 'jpeg', 'png', 'gif' => 'fa-file-image',
                                default => 'fa-file'
                            };
                            ?>
                            <i class="fas <?php echo $iconClass; ?>"></i>
                        </div>
                        
                        <div class="document-info">
                            <h3 class="document-name">
                                <?php echo esc($doc['nombre_documento'] ?: $doc['tipo_nombre']); ?>
                            </h3>
                            <div class="document-meta">
                                <span><i class="fas fa-calendar"></i> <?php echo date('d/m/Y', strtotime($doc['created_at'])); ?></span>
                                <span><i class="fas fa-hdd"></i> <?php echo number_format($doc['tamanio_bytes'] / 1024, 2); ?> KB</span>
                                <span class="upload-status-badge <?php echo $doc['estado']; ?>">
                                    <?php
                                    $estadoTexto = match($doc['estado']) {
                                        'pendiente' => 'Pendiente',
                                        'aprobado' => 'Aprobado',
                                        'rechazado' => 'Rechazado',
                                        default => 'Desconocido'
                                    };
                                    $estadoIcono = match($doc['estado']) {
                                        'pendiente' => 'fa-clock',
                                        'aprobado' => 'fa-check-circle',
                                        'rechazado' => 'fa-times-circle',
                                        default => 'fa-question-circle'
                                    };
                                    ?>
                                    <i class="fas <?php echo $estadoIcono; ?>"></i>
                                    <?php echo $estadoTexto; ?>
                                </span>
                            </div>
                            <?php if ($doc['observaciones']): ?>
                                <div class="document-observations">
                                    <strong>Observaciones:</strong> <?php echo esc($doc['observaciones']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="document-actions">
                            <button class="document-action-btn view" 
                                    onclick="viewDocument('<?php echo esc($doc['archivo_url']); ?>')"
                                    title="Ver documento">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="document-action-btn download" 
                                    onclick="downloadDocument('<?php echo esc($doc['archivo_url']); ?>', '<?php echo esc($doc['nombre_documento']); ?>')"
                                    title="Descargar">
                                <i class="fas fa-download"></i>
                            </button>
                            <?php if ($doc['estado'] !== 'aprobado'): ?>
                                <button class="document-action-btn delete" 
                                        onclick="deleteDocument(<?php echo $doc['id']; ?>)"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.documents-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.summary-card {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--card-shadow);
}

.summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.summary-info h3 {
    margin: 0 0 4px 0;
    font-size: 28px;
    color: var(--text-primary);
}

.summary-info p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 14px;
}

.section-card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: var(--card-shadow);
}

.section-card h2 {
    margin: 0 0 20px 0;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 12px;
}

.upload-form {
    max-width: 600px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-primary);
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--input-border);
    border-radius: 8px;
    font-size: 14px;
    background: var(--input-bg);
    color: var(--input-text);
}

.form-text {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: var(--text-secondary);
}

.btn-primary {
    background: var(--link-color);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    transition: all 0.3s ease;
}

.btn-primary:hover:not(:disabled) {
    background: var(--link-hover);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 64px;
    margin-bottom: 16px;
    opacity: 0.3;
}

.empty-state p {
    font-size: 18px;
    margin: 0 0 8px 0;
}

.document-observations {
    margin-top: 8px;
    padding: 8px 12px;
    background: rgba(255, 193, 7, 0.1);
    border-left: 3px solid var(--warning);
    border-radius: 4px;
    font-size: 13px;
}
</style>

<script>
let uploader;

document.addEventListener('DOMContentLoaded', function() {
    // Crear zona de upload
    uploader = createUploadZone('uploadZone', {
        text: 'Arrastra tu documento aquí o haz clic para seleccionar',
        accept: 'image/*,.pdf,.doc,.docx',
        maxSize: 10 * 1024 * 1024, // 10MB
        allowedExtensions: ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
        allowedMimes: ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        onSelect: (file) => {
            document.getElementById('uploadBtn').disabled = false;
        }
    });

    // Actualizar descripción al seleccionar tipo
    document.getElementById('documentType').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const descripcion = selectedOption.getAttribute('data-descripcion');
        document.getElementById('documentTypeHelp').textContent = descripcion || '';
    });

    // Manejar envío del formulario
    document.getElementById('uploadDocumentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const documentType = document.getElementById('documentType').value;
        const documentName = document.getElementById('documentName').value;
        const csrfToken = document.querySelector('input[name="csrf_token"]').value;
        
        if (!documentType) {
            Toast.error('Selecciona un tipo de documento');
            return;
        }
        
        if (!uploader.selectedFile) {
            Toast.error('Selecciona un archivo');
            return;
        }
        
        const uploadBtn = document.getElementById('uploadBtn');
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subiendo...';
        
        try {
            const response = await uploader.upload('php-bd/upload-document.php', {
                document_type: documentType,
                document_name: documentName || document.getElementById('documentType').options[document.getElementById('documentType').selectedIndex].text,
                csrf_token: csrfToken
            });
            
            if (response && response.success) {
                Toast.success(response.message || 'Documento subido correctamente');
                setTimeout(() => location.reload(), 1500);
            } else {
                Toast.error(response?.message || 'Error al subir el documento');
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Subir Documento';
            }
        } catch (error) {
            Toast.error('Error al subir el documento');
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Subir Documento';
        }
    });
});

function viewDocument(url) {
    window.open(url, '_blank');
}

function downloadDocument(url, filename) {
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

async function deleteDocument(id) {
    const confirmed = await Toast.confirm(
        '¿Estás seguro de eliminar este documento?',
        'Esta acción no se puede deshacer'
    );
    
    if (confirmed) {
        // Aquí iría la lógica de eliminación
        Toast.info('Funcionalidad en desarrollo');
    }
}
</script>

<?php require_once 'components/footer.php'; ?>
