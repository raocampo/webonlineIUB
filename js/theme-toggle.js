/**
 * Sistema de Modo Oscuro/Claro
 * Toggle entre temas con persistencia en localStorage
 */

class ThemeToggle {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'light';
        this.init();
    }

    init() {
        // Aplicar tema guardado al cargar
        this.applyTheme(this.theme);
        
        // Crear botón toggle si no existe
        this.createToggleButton();
        
        // Escuchar cambios de sistema (opcional)
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (!localStorage.getItem('theme')) {
                    this.setTheme(e.matches ? 'dark' : 'light');
                }
            });
        }
    }

    createToggleButton() {
        // Si ya existe el botón, actualizarlo
        let toggleBtn = document.getElementById('theme-toggle');
        
        if (!toggleBtn) {
            toggleBtn = document.createElement('button');
            toggleBtn.id = 'theme-toggle';
            toggleBtn.className = 'theme-toggle-btn';
            toggleBtn.setAttribute('aria-label', 'Cambiar tema');
            toggleBtn.setAttribute('title', 'Cambiar tema oscuro/claro');
            
            // Buscar header para insertar el botón
            const header = document.querySelector('.hero') || document.querySelector('.header');
            if (header) {
                header.appendChild(toggleBtn);
            } else {
                document.body.appendChild(toggleBtn);
            }
        }

        this.updateToggleButton(toggleBtn);
        
        toggleBtn.addEventListener('click', () => {
            this.toggleTheme();
        });
    }

    updateToggleButton(btn) {
        if (this.theme === 'dark') {
            btn.innerHTML = '<i class="fas fa-sun"></i>';
            btn.setAttribute('title', 'Cambiar a modo claro');
        } else {
            btn.innerHTML = '<i class="fas fa-moon"></i>';
            btn.setAttribute('title', 'Cambiar a modo oscuro');
        }
    }

    toggleTheme() {
        const newTheme = this.theme === 'light' ? 'dark' : 'light';
        this.setTheme(newTheme);
    }

    setTheme(theme) {
        this.theme = theme;
        this.applyTheme(theme);
        localStorage.setItem('theme', theme);
        
        const toggleBtn = document.getElementById('theme-toggle');
        if (toggleBtn) {
            this.updateToggleButton(toggleBtn);
        }

        // Disparar evento personalizado
        window.dispatchEvent(new CustomEvent('themechange', { detail: { theme } }));
    }

    applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark-mode');
            document.body.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
            document.body.classList.remove('dark-mode');
        }
    }

    getTheme() {
        return this.theme;
    }
}

// Auto-inicialización
let themeToggle;
document.addEventListener('DOMContentLoaded', () => {
    themeToggle = new ThemeToggle();
});

// Exportar para uso global
window.ThemeToggle = ThemeToggle;
