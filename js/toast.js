/**
 * Sistema de Notificaciones Toast
 * Sistema moderno de notificaciones sin dependencias externas
 */

class Toast {
    constructor() {
        this.container = null;
        this.init();
    }

    init() {
        // Crear contenedor si no existe
        if (!document.getElementById('toast-container')) {
            this.container = document.createElement('div');
            this.container.id = 'toast-container';
            this.container.className = 'toast-container';
            document.body.appendChild(this.container);
        } else {
            this.container = document.getElementById('toast-container');
        }
    }

    show(message, type = 'info', duration = 4000) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        
        // Icono según el tipo
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-exclamation-circle"></i>',
            warning: '<i class="fas fa-exclamation-triangle"></i>',
            info: '<i class="fas fa-info-circle"></i>'
        };

        toast.innerHTML = `
            <div class="toast-icon">${icons[type] || icons.info}</div>
            <div class="toast-message">${message}</div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        this.container.appendChild(toast);

        // Animación de entrada
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Auto-cerrar
        if (duration > 0) {
            setTimeout(() => {
                this.hide(toast);
            }, duration);
        }

        return toast;
    }

    hide(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }

    success(message, duration) {
        return this.show(message, 'success', duration);
    }

    error(message, duration) {
        return this.show(message, 'error', duration);
    }

    warning(message, duration) {
        return this.show(message, 'warning', duration);
    }

    info(message, duration) {
        return this.show(message, 'info', duration);
    }

    // Método para confirmar acciones
    confirm(message, onConfirm, onCancel) {
        const modal = document.createElement('div');
        modal.className = 'toast-modal';
        modal.innerHTML = `
            <div class="toast-modal-content">
                <div class="toast-modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <p class="toast-modal-message">${message}</p>
                <div class="toast-modal-buttons">
                    <button class="btn-cancel">Cancelar</button>
                    <button class="btn-confirm">Confirmar</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        
        // Event listeners
        modal.querySelector('.btn-confirm').addEventListener('click', () => {
            modal.remove();
            if (onConfirm) onConfirm();
        });

        modal.querySelector('.btn-cancel').addEventListener('click', () => {
            modal.remove();
            if (onCancel) onCancel();
        });

        // Cerrar al hacer clic fuera
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
                if (onCancel) onCancel();
            }
        });

        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }
}

// Inicializar instancia global
const toast = new Toast();

// Sobrescribir alert global para usar toast (opcional)
// window.alert = (message) => toast.info(message);
