-- Migración 002: Sistema de Upload de Archivos
-- Agrega soporte para fotos de perfil y documentos

-- 1. Agregar campo foto_perfil a usuarios
ALTER TABLE usuarios 
ADD COLUMN foto_perfil VARCHAR(255) DEFAULT NULL COMMENT 'URL de la foto de perfil del usuario'
AFTER correo;

-- 2. Crear tabla para documentos del usuario
CREATE TABLE IF NOT EXISTS documentos_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo_documento VARCHAR(50) NOT NULL COMMENT 'cedula, certificado_bachiller, foto_carnet, otros',
    nombre_documento VARCHAR(255) NOT NULL COMMENT 'Nombre descriptivo del documento',
    archivo_url VARCHAR(500) NOT NULL COMMENT 'Ruta del archivo subido',
    tamanio_bytes INT NOT NULL COMMENT 'Tamaño del archivo en bytes',
    extension VARCHAR(10) NOT NULL DEFAULT 'pdf',
    estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',
    observaciones TEXT DEFAULT NULL COMMENT 'Comentarios del administrador',
    revisado_por INT DEFAULT NULL COMMENT 'ID del admin que revisó',
    fecha_revision DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_documento_usuario 
        FOREIGN KEY (usuario_id) 
        REFERENCES usuarios(id) 
        ON DELETE CASCADE,
        
    CONSTRAINT fk_documento_revisor 
        FOREIGN KEY (revisado_por) 
        REFERENCES usuarios(id) 
        ON DELETE SET NULL,
        
    INDEX idx_usuario_documento (usuario_id, tipo_documento),
    INDEX idx_estado (estado),
    INDEX idx_fecha_creacion (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Crear directorio uploads (nota: debe crearse en el sistema de archivos)
-- mkdir -p matriculate-online/uploads/{profiles,documents,cedulas}
-- chmod 755 matriculate-online/uploads
-- chmod 755 matriculate-online/uploads/*

-- 4. Insertar tipos de documentos comunes (catálogo opcional)
CREATE TABLE IF NOT EXISTS tipos_documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    obligatorio BOOLEAN DEFAULT FALSE,
    orden INT DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Insertar tipos de documentos básicos
INSERT INTO tipos_documento (codigo, nombre, descripcion, obligatorio, orden) VALUES
('cedula_frontal', 'Cédula de Identidad (Frontal)', 'Copia a color de la parte frontal de la cédula', TRUE, 1),
('cedula_posterior', 'Cédula de Identidad (Posterior)', 'Copia a color de la parte posterior de la cédula', TRUE, 2),
('certificado_bachiller', 'Certificado de Bachiller', 'Certificado de título de bachiller', TRUE, 3),
('foto_carnet', 'Foto tipo carnet', 'Fotografía reciente tipo carnet fondo blanco', TRUE, 4),
('certificado_notas', 'Certificado de Notas', 'Certificado de notas del bachillerato', FALSE, 5),
('certificado_nacimiento', 'Certificado de Nacimiento', 'Partida de nacimiento actualizada', FALSE, 6),
('certificado_votacion', 'Certificado de Votación', 'Certificado del último proceso electoral', FALSE, 7);

-- 6. Vista para consultar documentos con información del usuario
CREATE OR REPLACE VIEW vista_documentos_usuario AS
SELECT 
    d.id,
    d.usuario_id,
    u.usuario AS usuario_nombre,
    u.nombres,
    u.apellidos,
    u.correo,
    d.tipo_documento,
    td.nombre AS tipo_documento_nombre,
    d.nombre_documento,
    d.archivo_url,
    d.tamanio_bytes,
    ROUND(d.tamanio_bytes / 1024 / 1024, 2) AS tamanio_mb,
    d.extension,
    d.estado,
    d.observaciones,
    d.revisado_por,
    r.usuario AS revisado_por_nombre,
    d.fecha_revision,
    d.created_at,
    d.updated_at
FROM documentos_usuario d
INNER JOIN usuarios u ON d.usuario_id = u.id
LEFT JOIN tipos_documento td ON d.tipo_documento = td.codigo
LEFT JOIN usuarios r ON d.revisado_por = r.id;

-- 7. Procedimiento almacenado para obtener documentos pendientes de un usuario
DELIMITER //

CREATE PROCEDURE sp_obtener_documentos_pendientes(IN p_usuario_id INT)
BEGIN
    SELECT 
        td.codigo,
        td.nombre,
        td.descripcion,
        td.obligatorio,
        CASE 
            WHEN du.id IS NOT NULL THEN 'subido'
            ELSE 'pendiente'
        END AS estado_upload,
        du.estado AS estado_revision,
        du.id AS documento_id,
        du.archivo_url,
        du.created_at AS fecha_subida
    FROM tipos_documento td
    LEFT JOIN documentos_usuario du 
        ON td.codigo = du.tipo_documento 
        AND du.usuario_id = p_usuario_id
    WHERE td.activo = TRUE
    ORDER BY td.orden;
END //

DELIMITER ;

-- 8. Trigger para actualizar fecha de actualización
DELIMITER //

CREATE TRIGGER trg_documento_update
BEFORE UPDATE ON documentos_usuario
FOR EACH ROW
BEGIN
    SET NEW.updated_at = NOW();
END //

DELIMITER ;

-- 9. Estadísticas de documentos por usuario
CREATE OR REPLACE VIEW vista_estadisticas_documentos AS
SELECT 
    u.id AS usuario_id,
    u.usuario,
    u.nombres,
    u.apellidos,
    COUNT(d.id) AS total_documentos,
    SUM(CASE WHEN d.estado = 'pendiente' THEN 1 ELSE 0 END) AS docs_pendientes,
    SUM(CASE WHEN d.estado = 'aprobado' THEN 1 ELSE 0 END) AS docs_aprobados,
    SUM(CASE WHEN d.estado = 'rechazado' THEN 1 ELSE 0 END) AS docs_rechazados,
    SUM(d.tamanio_bytes) AS total_bytes,
    ROUND(SUM(d.tamanio_bytes) / 1024 / 1024, 2) AS total_mb
FROM usuarios u
LEFT JOIN documentos_usuario d ON u.id = d.usuario_id
WHERE u.tipo != 'admin'
GROUP BY u.id;

-- 10. Comentarios de documentación
COMMENT ON TABLE documentos_usuario IS 'Almacena los documentos subidos por los usuarios para el proceso de matrícula';
COMMENT ON TABLE tipos_documento IS 'Catálogo de tipos de documentos requeridos para matrícula';

-- Fin de migración 002
