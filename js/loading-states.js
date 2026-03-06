/**
 * Sistema de Loading States
 * Indicadores visuales de carga para mejor UX
 */

class LoadingState {
    /**
     * Mostrar loading en un botón
     * @param {HTMLElement} button Botón a modificar
     * @param {string} text Texto durante la carga
     */
    static showButtonLoading(button, text = 'Procesando...') {
        if (!button) return;

        // Guardar estado original
        button.dataset.originalText = button.textContent;
        button.dataset.originalDisabled = button.disabled;

        // Aplicar loading
        button.textContent = text;
        button.disabled = true;
        button.classList.add('btn-loading');
    }

    /**
     * Ocultar loading de un botón
     * @param {HTMLElement} button Botón a restaurar
     */
    static hideButtonLoading(button) {
        if (!button) return;

        // Restaurar estado original
        button.textContent = button.dataset.originalText || 'Enviar';
        button.disabled = button.dataset.originalDisabled === 'true';
        button.classList.remove('btn-loading');

        // Limpiar dataset
        delete button.dataset.originalText;
        delete button.dataset.originalDisabled;
    }

    /**
     * Mostrar loading overlay en todo el contenido
     * @param {string} message Mensaje de carga
     */
    static showOverlay(message = 'Cargando...') {
        let overlay = document.getElementById('loading-overlay');
        
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'loading-overlay';
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="loading-spinner">
                    <div class="spinner"></div>
                    <p class="loading-message">${message}</p>
                </div>
            `;
            document.body.appendChild(overlay);
        } else {
            overlay.querySelector('.loading-message').textContent = message;
        }

        setTimeout(() => {
            overlay.classList.add('show');
        }, 10);
    }

    /**
     * Ocultar loading overlay
     */
    static hideOverlay() {
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.classList.remove('show');
            setTimeout(() => {
                overlay.remove();
            }, 300);
        }
    }

    /**
     * Mostrar skeleton loader en un contenedor
     * @param {HTMLElement} container Contenedor
     * @param {number} lines Número de líneas skeleton
     */
    static showSkeleton(container, lines = 3) {
        if (!container) return;

        const skeleton = document.createElement('div');
        skeleton.className = 'skeleton-loader';
        
        for (let i = 0; i < lines; i++) {
            const line = document.createElement('div');
            line.className = 'skeleton-line';
            if (i === lines - 1) {
                line.style.width = '60%'; // Última línea más corta
            }
            skeleton.appendChild(line);
        }

        container.innerHTML = '';
        container.appendChild(skeleton);
    }

    /**
     * Mostrar spinner inline
     * @param {HTMLElement} container Contenedor
     */
    static showInlineSpinner(container) {
        if (!container) return;

        const spinner = document.createElement('div');
        spinner.className = 'inline-spinner';
        spinner.innerHTML = '<div class="spinner-small"></div>';
        
        container.innerHTML = '';
        container.appendChild(spinner);
    }

    /**
     * Indicador de progreso
     * @param {number} percent Porcentaje (0-100)
     */
    static showProgress(percent) {
        let progressBar = document.getElementById('global-progress');
        
        if (!progressBar) {
            progressBar = document.createElement('div');
            progressBar.id = 'global-progress';
            progressBar.className = 'progress-bar';
            progressBar.innerHTML = '<div class="progress-fill"></div>';
            document.body.appendChild(progressBar);
        }

        const fill = progressBar.querySelector('.progress-fill');
        fill.style.width = percent + '%';
        progressBar.classList.add('show');

        if (percent >= 100) {
            setTimeout(() => {
                progressBar.classList.remove('show');
            }, 500);
        }
    }
}

// Utilidades adicionales
const Loading = {
    button: LoadingState.showButtonLoading,
    hideButton: LoadingState.hideButtonLoading,
    overlay: LoadingState.showOverlay,
    hideOverlay: LoadingState.hideOverlay,
    skeleton: LoadingState.showSkeleton,
    spinner: LoadingState.showInlineSpinner,
    progress: LoadingState.showProgress
};

// Auto-inicialización para forms con data-loading
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form[data-loading]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                LoadingState.showButtonLoading(submitBtn);
            }
        });
    });
});
