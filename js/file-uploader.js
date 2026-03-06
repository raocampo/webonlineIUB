/**
 * Sistema de Upload de Archivos
 * Manejo de uploads con preview, validación y progreso
 */

class FileUploader {
    constructor(options = {}) {
        this.options = {
            maxSize: options.maxSize || 5 * 1024 * 1024, // 5MB por defecto
            allowedExtensions: options.allowedExtensions || ['jpg', 'jpeg', 'png', 'gif'],
            allowedMimes: options.allowedMimes || ['image/jpeg', 'image/png', 'image/gif'],
            previewContainer: options.previewContainer || null,
            onSelect: options.onSelect || null,
            onUpload: options.onUpload || null,
            onError: options.onError || null,
            onProgress: options.onProgress || null,
            ...options
        };
        
        this.selectedFile = null;
    }

    /**
     * Inicializa el input de archivo
     */
    initInput(inputElement) {
        if (!inputElement) return;

        inputElement.addEventListener('change', (e) => {
            this.handleFileSelect(e.target.files[0]);
        });
    }

    /**
     * Maneja la selección de archivo
     */
    handleFileSelect(file) {
        if (!file) {
            this.showError('No se seleccionó ningún archivo');
            return;
        }

        const validation = this.validateFile(file);
        if (!validation.valid) {
            this.showError(validation.error);
            return;
        }

        this.selectedFile = file;
        
        // Mostrar preview si es imagen
        if (file.type.startsWith('image/')) {
            this.showPreview(file);
        }

        // Callback de selección
        if (this.options.onSelect) {
            this.options.onSelect(file);
        }
    }

    /**
     * Valida un archivo
     */
    validateFile(file) {
        // Verificar tamaño
        if (file.size > this.options.maxSize) {
            const maxSizeMB = (this.options.maxSize / 1024 / 1024).toFixed(2);
            return {
                valid: false,
                error: `El archivo es demasiado grande. Máximo: ${maxSizeMB}MB`
            };
        }

        // Verificar extensión
        const extension = file.name.split('.').pop().toLowerCase();
        if (!this.options.allowedExtensions.includes(extension)) {
            return {
                valid: false,
                error: `Extensión no permitida. Permitidas: ${this.options.allowedExtensions.join(', ')}`
            };
        }

        // Verificar MIME type
        if (!this.options.allowedMimes.includes(file.type)) {
            return {
                valid: false,
                error: 'Tipo de archivo no permitido'
            };
        }

        return { valid: true };
    }

    /**
     * Muestra preview de imagen
     */
    showPreview(file) {
        if (!this.options.previewContainer) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const container = document.querySelector(this.options.previewContainer);
            if (!container) return;

            container.innerHTML = `
                <div class="file-preview">
                    <img src="${e.target.result}" alt="Preview" class="preview-image">
                    <div class="preview-info">
                        <p class="preview-filename">${file.name}</p>
                        <p class="preview-size">${this.formatFileSize(file.size)}</p>
                    </div>
                    <button type="button" class="preview-remove" onclick="fileUploader.removeFile()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }

    /**
     * Sube el archivo al servidor
     */
    async upload(url, additionalData = {}) {
        if (!this.selectedFile) {
            this.showError('No hay archivo seleccionado');
            return null;
        }

        const formData = new FormData();
        formData.append('file', this.selectedFile);
        
        // Agregar datos adicionales
        for (const [key, value] of Object.entries(additionalData)) {
            formData.append(key, value);
        }

        try {
            const xhr = new XMLHttpRequest();

            // Progreso
            if (this.options.onProgress) {
                xhr.upload.addEventListener('progress', (e) => {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        this.options.onProgress(percentComplete);
                    }
                });
            }

            const response = await new Promise((resolve, reject) => {
                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        try {
                            resolve(JSON.parse(xhr.responseText));
                        } catch (e) {
                            resolve(xhr.responseText);
                        }
                    } else {
                        reject(new Error(`HTTP ${xhr.status}: ${xhr.statusText}`));
                    }
                };

                xhr.onerror = () => reject(new Error('Error de red'));
                xhr.open('POST', url, true);
                xhr.send(formData);
            });

            // Callback de éxito
            if (this.options.onUpload) {
                this.options.onUpload(response);
            }

            return response;

        } catch (error) {
            this.showError(error.message);
            return null;
        }
    }

    /**
     * Elimina el archivo seleccionado
     */
    removeFile() {
        this.selectedFile = null;
        
        if (this.options.previewContainer) {
            const container = document.querySelector(this.options.previewContainer);
            if (container) {
                container.innerHTML = '';
            }
        }

        // Limpiar input
        const inputs = document.querySelectorAll('input[type="file"]');
        inputs.forEach(input => input.value = '');
    }

    /**
     * Muestra error
     */
    showError(message) {
        if (this.options.onError) {
            this.options.onError(message);
        } else if (typeof Toast !== 'undefined') {
            Toast.error(message);
        } else {
            alert(message);
        }
    }

    /**
     * Formatea el tamaño del archivo
     */
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Crea un drag & drop zone
     */
    createDropZone(element) {
        if (!element) return;

        const dropZone = typeof element === 'string' ? document.querySelector(element) : element;
        if (!dropZone) return;

        // Prevenir comportamiento por defecto
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        // Resaltar zona al arrastrar
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('drag-active');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('drag-active');
            });
        });

        // Manejar drop
        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                this.handleFileSelect(files[0]);
            }
        });
    }
}

/**
 * Helper para crear zona de upload con interfaz completa
 */
function createUploadZone(containerId, options = {}) {
    const container = document.getElementById(containerId);
    if (!container) return null;

    const uploadId = 'upload-' + Math.random().toString(36).substr(2, 9);
    
    container.innerHTML = `
        <div class="upload-zone" id="${uploadId}">
            <div class="upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <p class="upload-text">
                ${options.text || 'Arrastra un archivo aquí o haz clic para seleccionar'}
            </p>
            <input type="file" id="${uploadId}-input" class="upload-input" 
                accept="${options.accept || 'image/*'}" hidden>
            <button type="button" class="upload-btn" onclick="document.getElementById('${uploadId}-input').click()">
                Seleccionar Archivo
            </button>
            <div class="upload-preview" id="${uploadId}-preview"></div>
            <div class="upload-progress" id="${uploadId}-progress" style="display: none;">
                <div class="progress-bar"></div>
                <span class="progress-text">0%</span>
            </div>
        </div>
    `;

    const uploader = new FileUploader({
        ...options,
        previewContainer: `#${uploadId}-preview`,
        onProgress: (percent) => {
            const progressBar = document.querySelector(`#${uploadId}-progress .progress-bar`);
            const progressText = document.querySelector(`#${uploadId}-progress .progress-text`);
            const progressContainer = document.getElementById(`${uploadId}-progress`);
            
            if (progressContainer) {
                progressContainer.style.display = 'block';
            }
            if (progressBar) {
                progressBar.style.width = percent + '%';
            }
            if (progressText) {
                progressText.textContent = Math.round(percent) + '%';
            }
        }
    });

    const input = document.getElementById(`${uploadId}-input`);
    uploader.initInput(input);
    uploader.createDropZone(`#${uploadId}`);

    return uploader;
}

// Exportar para uso global
window.FileUploader = FileUploader;
window.createUploadZone = createUploadZone;
