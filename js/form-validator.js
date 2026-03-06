/**
 * Sistema de Validación de Formularios
 * Validación en tiempo real con feedback visual
 */

class FormValidator {
    constructor(form) {
        this.form = typeof form === 'string' ? document.querySelector(form) : form;
        this.rules = {};
        this.errors = {};
        this.init();
    }

    init() {
        if (!this.form) {
            console.error('Formulario no encontrado');
            return;
        }

        this.form.setAttribute('novalidate', 'true');
        
        // Event listener para submit
        this.form.addEventListener('submit', (e) => {
            if (!this.validateAll()) {
                e.preventDefault();
                this.showErrors();
            }
        });

        // Validación en tiempo real
        this.form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
            field.addEventListener('input', () => {
                if (field.classList.contains('is-invalid')) {
                    this.validateField(field);
                }
            });
        });
    }

    /**
     * Agregar reglas de validación
     * @param {string} fieldName Nombre del campo
     * @param {Array} rules Array de reglas
     */
    addRules(fieldName, rules) {
        this.rules[fieldName] = rules;
        return this;
    }

    /**
     * Validar un campo específico
     */
    validateField(field) {
        const fieldName = field.name;
        const value = field.value.trim();
        const rules = this.rules[fieldName] || [];

        // Limpiar errores previos
        this.clearFieldError(field);

        // Aplicar reglas
        for (const rule of rules) {
            const error = this.applyRule(value, rule, field);
            if (error) {
                this.errors[fieldName] = error;
                this.showFieldError(field, error);
                return false;
            }
        }

        delete this.errors[fieldName];
        this.showFieldSuccess(field);
        return true;
    }

    /**
     * Aplicar una regla de validación
     */
    applyRule(value, rule, field) {
        // Regla requerida
        if (rule === 'required' && !value) {
            return 'Este campo es obligatorio';
        }

        // Regla email
        if (rule === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (value && !emailRegex.test(value)) {
                return 'Ingrese un email válido';
            }
        }

        // Regla numérica
        if (rule === 'numeric' && value && !/^\d+$/.test(value)) {
            return 'Solo se permiten números';
        }

        // Regla alfanumérica
        if (rule === 'alphanumeric' && value && !/^[a-zA-Z0-9]+$/.test(value)) {
            return 'Solo se permiten letras y números';
        }

        // Regla de longitud mínima
        if (typeof rule === 'object' && rule.min) {
            if (value && value.length < rule.min) {
                return `Mínimo ${rule.min} caracteres`;
            }
        }

        // Regla de longitud máxima
        if (typeof rule === 'object' && rule.max) {
            if (value && value.length > rule.max) {
                return `Máximo ${rule.max} caracteres`;
            }
        }

        // Regla de coincidencia
        if (typeof rule === 'object' && rule.matches) {
            const matchField = this.form.querySelector(`[name="${rule.matches}"]`);
            if (matchField && value !== matchField.value) {
                return rule.message || 'Los campos no coinciden';
            }
        }

        // Regla personalizada (función)
        if (typeof rule === 'function') {
            return rule(value, field);
        }

        return null;
    }

    /**
     * Validar todos los campos
     */
    validateAll() {
        this.errors = {};
        let isValid = true;

        for (const fieldName in this.rules) {
            const field = this.form.querySelector(`[name="${fieldName}"]`);
            if (field && !this.validateField(field)) {
                isValid = false;
            }
        }

        return isValid;
    }

    /**
     * Mostrar error en un campo
     */
    showFieldError(field, message) {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');

        // Crear o actualizar mensaje de error
        let errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            field.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
    }

    /**
     * Mostrar éxito en un campo
     */
    showFieldSuccess(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');

        const errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    }

    /**
     * Limpiar error de un campo
     */
    clearFieldError(field) {
        field.classList.remove('is-valid', 'is-invalid');
        const errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    }

    /**
     * Mostrar todos los errores
     */
    showErrors() {
        if (Object.keys(this.errors).length > 0) {
            const firstError = Object.keys(this.errors)[0];
            const firstField = this.form.querySelector(`[name="${firstError}"]`);
            if (firstField) {
                firstField.focus();
                firstField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Mostrar toast con resumen
            if (typeof toast !== 'undefined') {
                toast.error('Por favor corrija los errores en el formulario');
            }
        }
    }

    /**
     * Resetear formulario
     */
    reset() {
        this.form.reset();
        this.errors = {};
        this.form.querySelectorAll('.is-invalid, .is-valid').forEach(field => {
            this.clearFieldError(field);
        });
    }

    /**
     * Obtener datos del formulario
     */
    getData() {
        const formData = new FormData(this.form);
        const data = {};
        for (const [key, value] of formData.entries()) {
            data[key] = value;
        }
        return data;
    }
}

// Validaciones comunes predefinidas
const ValidationRules = {
    email: ['required', 'email'],
    password: ['required', { min: 6 }],
    text: ['required'],
    phone: ['required', 'numeric', { min: 10, max: 10 }],
    cedula: ['required', 'numeric', { min: 10, max: 10 }],
    alphanumeric: ['required', 'alphanumeric']
};

// Ejemplo de uso:
/*
const validator = new FormValidator('#registroForm');
validator
    .addRules('nombre', ['required'])
    .addRules('email', ValidationRules.email)
    .addRules('password', ValidationRules.password)
    .addRules('confirm_password', [
        'required',
        { matches: 'password', message: 'Las contraseñas no coinciden' }
    ]);
*/
