/**
 * Sistema de FAQ Interactivo
 * Accordion con búsqueda y filtrado por categorías
 */

class FAQSystem {
    constructor(options = {}) {
        this.container = options.container || '#faqContainer';
        this.searchInput = options.searchInput || '#faqSearch';
        this.categoryFilter = options.categoryFilter || '#faqCategory';
        this.faqs = [];
        
        this.init();
    }

    init() {
        this.bindEvents();
    }

    /**
     * Carga FAQs desde datos
     */
    loadFAQs(faqs) {
        this.faqs = faqs;
        this.render();
    }

    /**
     * Vincula eventos
     */
    bindEvents() {
        // Búsqueda
        const searchInput = document.querySelector(this.searchInput);
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filterFAQs(e.target.value);
            });
        }

        // Filtro por categoría
        const categoryFilter = document.querySelector(this.categoryFilter);
        if (categoryFilter) {
            categoryFilter.addEventListener('change', (e) => {
                this.filterByCategory(e.target.value);
            });
        }
    }

    /**
     * Renderiza FAQs
     */
    render(faqsToRender = null) {
        const container = document.querySelector(this.container);
        if (!container) return;

        const faqs = faqsToRender || this.faqs;
        
        if (faqs.length === 0) {
            container.innerHTML = `
                <div class="faq-empty">
                    <i class="fas fa-search"></i>
                    <p>No se encontraron preguntas que coincidan con tu búsqueda</p>
                </div>
            `;
            return;
        }

        let html = '<div class="faq-accordion">';
        
        faqs.forEach((faq, index) => {
            html += `
                <div class="faq-item" data-category="${faq.category}">
                    <button class="faq-question" onclick="faqSystem.toggleFAQ(${index})">
                        <span class="faq-question-text">${this.highlightText(faq.question)}</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer" id="faq-answer-${index}">
                        <div class="faq-answer-content">
                            ${faq.answer}
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        
        container.innerHTML = html;
    }

    /**
     * Toggle FAQ item
     */
    toggleFAQ(index) {
        const answer = document.getElementById(`faq-answer-${index}`);
        const question = answer.previousElementSibling;
        const icon = question.querySelector('.faq-icon');
        
        // Cerrar otros FAQs (accordion behavior)
        document.querySelectorAll('.faq-answer').forEach((item, i) => {
            if (i !== index && item.classList.contains('active')) {
                item.classList.remove('active');
                item.previousElementSibling.classList.remove('active');
                item.previousElementSibling.querySelector('.faq-icon').classList.remove('rotate');
            }
        });

        // Toggle actual
        answer.classList.toggle('active');
        question.classList.toggle('active');
        icon.classList.toggle('rotate');
    }

    /**
     * Filtra FAQs por texto de búsqueda
     */
    filterFAQs(searchText) {
        this.currentSearch = searchText.toLowerCase();
        
        const filtered = this.faqs.filter(faq => {
            const questionMatch = faq.question.toLowerCase().includes(this.currentSearch);
            const answerMatch = faq.answer.toLowerCase().includes(this.currentSearch);
            const categoryMatch = !this.currentCategory || faq.category === this.currentCategory;
            
            return (questionMatch || answerMatch) && categoryMatch;
        });
        
        this.render(filtered);
    }

    /**
     * Filtra por categoría
     */
    filterByCategory(category) {
        this.currentCategory = category === 'all' ? null : category;
        
        const filtered = this.faqs.filter(faq => {
            const categoryMatch = !this.currentCategory || faq.category === this.currentCategory;
            const searchMatch = !this.currentSearch || 
                faq.question.toLowerCase().includes(this.currentSearch) ||
                faq.answer.toLowerCase().includes(this.currentSearch);
            
            return categoryMatch && searchMatch;
        });
        
        this.render(filtered);
    }

    /**
     * Resalta texto de búsqueda
     */
    highlightText(text) {
        if (!this.currentSearch || this.currentSearch.length < 2) {
            return text;
        }

        const regex = new RegExp(`(${this.currentSearch})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    /**
     * Expandir todos
     */
    expandAll() {
        document.querySelectorAll('.faq-answer').forEach(answer => {
            answer.classList.add('active');
            answer.previousElementSibling.classList.add('active');
            answer.previousElementSibling.querySelector('.faq-icon').classList.add('rotate');
        });
    }

    /**
     * Colapsar todos
     */
    collapseAll() {
        document.querySelectorAll('.faq-answer').forEach(answer => {
            answer.classList.remove('active');
            answer.previousElementSibling.classList.remove('active');
            answer.previousElementSibling.querySelector('.faq-icon').classList.remove('rotate');
        });
    }

    /**
     * Obtener categorías únicas
     */
    getCategories() {
        const categories = new Set();
        this.faqs.forEach(faq => categories.add(faq.category));
        return Array.from(categories);
    }
}

// Datos de ejemplo de FAQs
const faqData = [
    {
        category: 'matricula',
        question: '¿Cómo me matriculo en el Instituto Bolivariano?',
        answer: `
            <p>Para matricularte en el Instituto Bolivariano, sigue estos pasos:</p>
            <ol>
                <li>Ingresa con tu usuario y contraseña</li>
                <li>Completa tus datos personales en el perfil</li>
                <li>Sube los documentos requeridos (cédula, certificado de bachiller, foto)</li>
                <li>Selecciona la carrera de tu interés</li>
                <li>Realiza el pago de matrícula</li>
                <li>Espera la confirmación del área administrativa</li>
            </ol>
        `
    },
    {
        category: 'matricula',
        question: '¿Qué documentos necesito para matricularme?',
        answer: `
            <p>Los documentos requeridos son:</p>
            <ul>
                <li>Cédula de identidad (frontal y posterior)</li>
                <li>Certificado de bachiller</li>
                <li>Foto tipo carnet (fondo blanco)</li>
                <li>Certificado de notas del bachillerato</li>
                <li>Certificado de votación (si eres mayor de 18 años)</li>
            </ul>
            <p>Puedes subir estos documentos desde la sección "Mis Documentos".</p>
        `
    },
    {
        category: 'pagos',
        question: '¿Cuáles son las formas de pago disponibles?',
        answer: `
            <p>Aceptamos las siguientes formas de pago:</p>
            <ul>
                <li><strong>Transferencia bancaria:</strong> Banco Pichincha, Cuenta N° 1234567890</li>
                <li><strong>Depósito bancario:</strong> En ventanilla o cajero automático</li>
                <li><strong>Pago en línea:</strong> Con tarjeta de débito o crédito</li>
                <li><strong>Pago en efectivo:</strong> En nuestras oficinas</li>
            </ul>
            <p>Recuerda subir el comprobante de pago en la sección "Mis Finanzas".</p>
        `
    },
    {
        category: 'pagos',
        question: '¿Puedo pagar en cuotas?',
        answer: `
            <p>Sí, ofrecemos planes de pago flexibles. Puedes solicitar un plan de pagos:</p>
            <ul>
                <li>Plan de 3 cuotas mensuales</li>
                <li>Plan de 6 cuotas mensuales</li>
                <li>Plan personalizado (según tu situación económica)</li>
            </ul>
            <p>Para solicitar un plan de pagos, dirígete a "Mis Finanzas" > "Plan de Pagos".</p>
        `
    },
    {
        category: 'carreras',
        question: '¿Qué carreras ofrece el Instituto Bolivariano?',
        answer: `
            <p>Ofrecemos las siguientes carreras tecnológicas superiores:</p>
            <ul>
                <li>Administración de Empresas</li>
                <li>Contabilidad y Finanzas</li>
                <li>Tecnología de la Información</li>
                <li>Gestión de Calidad y Productividad</li>
                <li>Educación Inicial</li>
                <li>Educación Básica</li>
                <li>Enfermería</li>
            </ul>
            <p>Todas nuestras carreras están en modalidad 100% online.</p>
        `
    },
    {
        category: 'carreras',
        question: '¿Cuánto dura cada carrera?',
        answer: `
            <p>Todas nuestras carreras tecnológicas tienen una duración de <strong>2 años y medio</strong> (5 semestres).</p>
            <p>Al finalizar, obtienes el título de Tecnólogo Superior, avalado por SENESCYT.</p>
        `
    },
    {
        category: 'aula_virtual',
        question: '¿Cómo accedo al aula virtual?',
        answer: `
            <p>Para acceder al aula virtual:</p>
            <ol>
                <li>Haz clic en "Aula Virtual" en el menú principal</li>
                <li>Ingresa con tu usuario y contraseña</li>
                <li>Selecciona tu carrera y semestre</li>
                <li>Accede a las materias disponibles</li>
            </ol>
            <p>El aula virtual está disponible 24/7 para que estudies a tu ritmo.</p>
        `
    },
    {
        category: 'aula_virtual',
        question: '¿Qué hago si no puedo acceder al aula virtual?',
        answer: `
            <p>Si tienes problemas para acceder:</p>
            <ul>
                <li>Verifica que tu usuario y contraseña sean correctos</li>
                <li>Asegúrate de haber completado el proceso de matrícula</li>
                <li>Verifica que tu pago esté registrado y aprobado</li>
                <li>Limpia la caché de tu navegador</li>
            </ul>
            <p>Si el problema persiste, contacta a soporte técnico: soporte@tbolivariano.edu.ec</p>
        `
    },
    {
        category: 'tecnico',
        question: '¿Qué navegador debo usar?',
        answer: `
            <p>Recomendamos usar navegadores modernos actualizados:</p>
            <ul>
                <li>Google Chrome (versión 90 o superior)</li>
                <li>Mozilla Firefox (versión 88 o superior)</li>
                <li>Microsoft Edge (versión 90 o superior)</li>
                <li>Safari (versión 14 o superior)</li>
            </ul>
        `
    },
    {
        category: 'tecnico',
        question: '¿Por qué no puedo subir documentos?',
        answer: `
            <p>Verifica lo siguiente:</p>
            <ul>
                <li>El archivo no debe superar los 5MB para imágenes o 10MB para documentos</li>
                <li>Los formatos permitidos son: JPG, PNG, PDF</li>
                <li>Verifica tu conexión a internet</li>
                <li>Intenta con un navegador diferente</li>
            </ul>
            <p>Si el problema continúa, contacta a soporte técnico.</p>
        `
    }
];

// Exportar para uso global
window.FAQSystem = FAQSystem;
window.faqData = faqData;
