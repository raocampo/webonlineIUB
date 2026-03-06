<?php
/**
 * Helper para manejar uploads de archivos de manera segura
 */

class UploadHelper {
    
    /**
     * Configuración de tipos de archivo permitidos
     */
    private static $allowedTypes = [
        'image' => [
            'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
            'mimes' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            'maxSize' => 5 * 1024 * 1024, // 5MB
        ],
        'document' => [
            'extensions' => ['pdf', 'doc', 'docx', 'txt'],
            'mimes' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'],
            'maxSize' => 10 * 1024 * 1024, // 10MB
        ],
        'cedula' => [
            'extensions' => ['jpg', 'jpeg', 'png', 'pdf'],
            'mimes' => ['image/jpeg', 'image/png', 'application/pdf'],
            'maxSize' => 5 * 1024 * 1024, // 5MB
        ],
    ];

    /**
     * Rutas de upload
     */
    private static $uploadPaths = [
        'profile' => __DIR__ . '/../uploads/profiles/',
        'documents' => __DIR__ . '/../uploads/documents/',
        'cedula' => __DIR__ . '/../uploads/cedulas/',
    ];

    /**
     * Valida un archivo subido
     * 
     * @param array $file Datos del archivo ($_FILES['nombre'])
     * @param string $type Tipo de archivo (image, document, cedula)
     * @return array ['success' => bool, 'message' => string, 'error' => string]
     */
    public static function validateFile($file, $type = 'image') {
        // Verificar que el archivo existe
        if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return [
                'success' => false,
                'error' => 'no_file',
                'message' => 'No se ha seleccionado ningún archivo.'
            ];
        }

        // Verificar errores de upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'error' => 'upload_error',
                'message' => self::getUploadErrorMessage($file['error'])
            ];
        }

        // Verificar tipo de archivo válido
        if (!isset(self::$allowedTypes[$type])) {
            return [
                'success' => false,
                'error' => 'invalid_type',
                'message' => 'Tipo de archivo no válido.'
            ];
        }

        $config = self::$allowedTypes[$type];
        
        // Verificar tamaño
        if ($file['size'] > $config['maxSize']) {
            $maxSizeMB = $config['maxSize'] / 1024 / 1024;
            return [
                'success' => false,
                'error' => 'file_too_large',
                'message' => "El archivo es demasiado grande. Máximo permitido: {$maxSizeMB}MB."
            ];
        }

        // Obtener extensión del archivo
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Verificar extensión
        if (!in_array($extension, $config['extensions'])) {
            $allowedExt = implode(', ', $config['extensions']);
            return [
                'success' => false,
                'error' => 'invalid_extension',
                'message' => "Extensión de archivo no permitida. Permitidas: {$allowedExt}."
            ];
        }

        // Verificar MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $config['mimes'])) {
            return [
                'success' => false,
                'error' => 'invalid_mime',
                'message' => 'Tipo de archivo no permitido.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Archivo válido.',
            'extension' => $extension,
            'mime' => $mimeType
        ];
    }

    /**
     * Sube un archivo al servidor
     * 
     * @param array $file Datos del archivo ($_FILES['nombre'])
     * @param string $category Categoría de upload (profile, documents, cedula)
     * @param string $type Tipo de archivo para validación
     * @param int $userId ID del usuario (para nombrar archivos)
     * @param string $prefix Prefijo opcional para el nombre del archivo
     * @return array ['success' => bool, 'message' => string, 'filename' => string, 'path' => string]
     */
    public static function uploadFile($file, $category, $type, $userId, $prefix = '') {
        // Validar archivo
        $validation = self::validateFile($file, $type);
        if (!$validation['success']) {
            return $validation;
        }

        // Verificar categoría válida
        if (!isset(self::$uploadPaths[$category])) {
            return [
                'success' => false,
                'error' => 'invalid_category',
                'message' => 'Categoría de upload no válida.'
            ];
        }

        $uploadPath = self::$uploadPaths[$category];
        
        // Crear directorio si no existe
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true)) {
                return [
                    'success' => false,
                    'error' => 'directory_error',
                    'message' => 'No se pudo crear el directorio de destino.'
                ];
            }
        }

        // Generar nombre de archivo único y seguro
        $extension = $validation['extension'];
        $filename = $prefix . 'user_' . $userId . '_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        $filePath = $uploadPath . $filename;

        // Mover archivo
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            return [
                'success' => false,
                'error' => 'move_error',
                'message' => 'No se pudo guardar el archivo.'
            ];
        }

        // Aplicar permisos seguros
        chmod($filePath, 0644);

        return [
            'success' => true,
            'message' => 'Archivo subido correctamente.',
            'filename' => $filename,
            'path' => $filePath,
            'url' => 'uploads/' . $category . '/' . $filename
        ];
    }

    /**
     * Elimina un archivo del servidor
     * 
     * @param string $category Categoría (profile, documents, cedula)
     * @param string $filename Nombre del archivo
     * @return bool
     */
    public static function deleteFile($category, $filename) {
        if (!isset(self::$uploadPaths[$category])) {
            return false;
        }

        $filePath = self::$uploadPaths[$category] . $filename;
        
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    /**
     * Redimensiona una imagen para optimización
     * 
     * @param string $sourcePath Ruta de la imagen original
     * @param string $destPath Ruta de destino
     * @param int $maxWidth Ancho máximo
     * @param int $maxHeight Alto máximo
     * @return bool
     */
    public static function resizeImage($sourcePath, $destPath, $maxWidth = 800, $maxHeight = 800) {
        // Obtener información de la imagen
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            return false;
        }

        list($width, $height, $type) = $imageInfo;

        // Calcular nuevas dimensiones manteniendo aspecto
        $ratio = min($maxWidth / $width, $maxHeight / $height);
        if ($ratio >= 1) {
            // No redimensionar si la imagen es más pequeña
            return copy($sourcePath, $destPath);
        }

        $newWidth = round($width * $ratio);
        $newHeight = round($height * $ratio);

        // Crear imagen desde archivo
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $source = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        if (!$source) {
            return false;
        }

        // Crear imagen nueva
        $dest = imagecreatetruecolor($newWidth, $newHeight);

        // Preservar transparencia para PNG y GIF
        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_GIF) {
            imagealphablending($dest, false);
            imagesavealpha($dest, true);
            $transparent = imagecolorallocatealpha($dest, 255, 255, 255, 127);
            imagefilledrectangle($dest, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Redimensionar
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Guardar imagen
        $result = false;
        switch ($type) {
            case IMAGETYPE_JPEG:
                $result = imagejpeg($dest, $destPath, 90);
                break;
            case IMAGETYPE_PNG:
                $result = imagepng($dest, $destPath, 9);
                break;
            case IMAGETYPE_GIF:
                $result = imagegif($dest, $destPath);
                break;
            case IMAGETYPE_WEBP:
                $result = imagewebp($dest, $destPath, 90);
                break;
        }

        // Liberar memoria
        imagedestroy($source);
        imagedestroy($dest);

        return $result;
    }

    /**
     * Obtiene mensaje de error de upload
     * 
     * @param int $errorCode Código de error de PHP
     * @return string
     */
    private static function getUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return 'El archivo excede el tamaño máximo permitido.';
            case UPLOAD_ERR_PARTIAL:
                return 'El archivo se subió parcialmente. Intente nuevamente.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Falta el directorio temporal.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Error al escribir el archivo en el disco.';
            case UPLOAD_ERR_EXTENSION:
                return 'Una extensión de PHP detuvo la subida del archivo.';
            default:
                return 'Error desconocido al subir el archivo.';
        }
    }

    /**
     * Obtiene información sobre un tipo de archivo
     * 
     * @param string $type Tipo de archivo
     * @return array|null
     */
    public static function getTypeInfo($type) {
        return self::$allowedTypes[$type] ?? null;
    }
}
