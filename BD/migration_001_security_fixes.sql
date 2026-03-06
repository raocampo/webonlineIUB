-- =====================================================
-- SCRIPT DE MIGRACIÓN PARA CORREGIR BASE DE DATOS
-- Versión: 1.0
-- Fecha: 2026-03-04
-- Descripción: Corrige problemas estructurales y de seguridad
-- =====================================================

-- 1. AGREGAR CAMPO 'tipo' A LA TABLA usuarios
-- =====================================================
ALTER TABLE `usuarios` 
ADD COLUMN `tipo` CHAR(1) NOT NULL DEFAULT 'E' COMMENT 'E=Estudiante, A=Administrador' AFTER `correo`;

-- Actualizar registros existentes (admin como A, resto como E)
UPDATE `usuarios` SET `tipo` = 'A' WHERE `usuario` = 'admin';
UPDATE `usuarios` SET `tipo` = 'E' WHERE `usuario` != 'admin' AND `tipo` IS NULL;

-- 2. AGREGAR ÍNDICES PARA OPTIMIZACIÓN
-- =====================================================
-- Índice en el campo usuario para búsquedas rápidas
ALTER TABLE `usuarios` ADD INDEX `idx_usuario` (`usuario`);
ALTER TABLE `usu_dts` ADD INDEX `idx_usuario` (`usuario`);
ALTER TABLE `usu_dmc` ADD INDEX `idx_usuario` (`usuario`);
ALTER TABLE `fnc_pgsp` ADD INDEX `idx_usuario` (`usuario`);
ALTER TABLE `fnc_pgsa` ADD INDEX `idx_usuario` (`usuario`);

-- Índice en el campo tipo para filtros
ALTER TABLE `usuarios` ADD INDEX `idx_tipo` (`tipo`);

-- 3. AGREGAR FOREIGN KEYS PARA INTEGRIDAD REFERENCIAL
-- =====================================================
-- Primero, asegurar que no haya datos huérfanos
DELETE FROM `usu_dts` WHERE `usuario` NOT IN (SELECT `usuario` FROM `usuarios`);
DELETE FROM `usu_dmc` WHERE `usuario` NOT IN (SELECT `usuario` FROM `usuarios`);
DELETE FROM `fnc_pgsp` WHERE `usuario` NOT IN (SELECT `usuario` FROM `usuarios`);
DELETE FROM `fnc_pgsa` WHERE `usuario` NOT IN (SELECT `usuario` FROM `usuarios`);

-- Luego, agregar las foreign keys
ALTER TABLE `usu_dts` 
ADD CONSTRAINT `fk_usu_dts_usuario` 
FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) 
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usu_dmc` 
ADD CONSTRAINT `fk_usu_dmc_usuario` 
FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) 
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `fnc_pgsp` 
ADD CONSTRAINT `fk_fnc_pgsp_usuario` 
FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) 
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `fnc_pgsa` 
ADD CONSTRAINT `fk_fnc_pgsa_usuario` 
FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) 
ON DELETE CASCADE ON UPDATE CASCADE;

-- 4. AGREGAR TIMESTAMPS PARA AUDITORÍA
-- =====================================================
ALTER TABLE `usuarios` 
ADD COLUMN `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE `usu_dts` 
ADD COLUMN `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- 5. AGREGAR CAMPOS DE SEGURIDAD ADICIONALES
-- =====================================================
ALTER TABLE `usuarios` 
ADD COLUMN `last_login` TIMESTAMP NULL,
ADD COLUMN `login_attempts` INT DEFAULT 0,
ADD COLUMN `locked_until` TIMESTAMP NULL,
ADD COLUMN `email_verified` BOOLEAN DEFAULT FALSE;

-- 6. CREAR TABLA DE SESIONES (Para seguridad mejorada)
-- =====================================================
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(128) NOT NULL PRIMARY KEY,
  `usuario` VARCHAR(15) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(255),
  `last_activity` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` TEXT,
  INDEX `idx_usuario` (`usuario`),
  INDEX `idx_last_activity` (`last_activity`),
  FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 7. CREAR TABLA DE LOGS DE ACTIVIDAD
-- =====================================================
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario` VARCHAR(15),
  `action` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `ip_address` VARCHAR(45),
  `user_agent` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_usuario` (`usuario`),
  INDEX `idx_created_at` (`created_at`),
  FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`usuario`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 8. DEPRECATED: Marcar tabla 'users' como obsoleta
-- =====================================================
-- Nota: Esta tabla debe ser eliminada después de migrar todos los datos
-- Por ahora solo renombramos para evitar confusión
ALTER TABLE `users` RENAME TO `users_DEPRECATED_DO_NOT_USE`;

-- 9. CREAR VISTA PARA DATOS COMPLETOS DEL USUARIO
-- =====================================================
CREATE OR REPLACE VIEW `v_usuarios_completos` AS
SELECT 
    u.id,
    u.usuario,
    u.correo,
    u.tipo,
    u.created_at,
    u.last_login,
    d.nombres,
    d.identificacion,
    d.nmr_tel,
    d.fch_nac,
    d.est_cvl,
    d.direccion,
    d.pais,
    d.provincia,
    d.ciudad,
    dm.cll_prn,
    dm.cll_scn,
    dm.cdg_pst,
    dm.tlf_cnt,
    dm.referencia
FROM usuarios u
LEFT JOIN usu_dts d ON u.usuario = d.usuario
LEFT JOIN usu_dmc dm ON u.usuario = dm.usuario;

-- =====================================================
-- FIN DEL SCRIPT DE MIGRACIÓN
-- =====================================================
