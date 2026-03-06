# 🎓 Instituto Superior Universitario Bolivariano - Plataforma Online

![Version](https://img.shields.io/badge/version-2.1.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

Plataforma web completa para el Instituto Superior Universitario Bolivariano, modalidad online. Sistema moderno de gestión académica y matrícula online con tecnologías actualizadas y mejores prácticas de seguridad.

## 📋 Tabla de Contenidos

- [Características](#características)
- [Tecnologías](#tecnologías)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Checklist de Publicación](#-checklist-de-publicación-pre-producción)
- [Mejoras Implementadas](#mejoras-implementadas)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Seguridad](#seguridad)
- [Contribución](#contribución)
- [Licencia](#licencia)

## ✨ Características

### Portal Principal
- 🎨 Diseño responsive y moderno
- 🚀 Optimización SEO completa (Open Graph, Twitter Cards, Schema.org)
- 📱 Navegación adaptativa móvil/desktop
- 🖼️ Lazy loading de imágenes para mejor rendimiento
- 📰 Sección de eventos y noticias
- 📝 Formulario de contacto integrado con WhatsApp
- 🎯 Accesos directos a servicios académicos

### Sistema de Matrícula Online
- 🔐 Autenticación segura con hashing bcrypt
- 👤 Gestión de perfil de estudiante
- 💰 Módulo de finanzas y pagos
- 📚 Acceso a aula virtual
- 📄 Trámites en línea
- 🔔 Sistema de notificaciones modernas (Toast)
- 🛡️ Protección CSRF y XSS
- 📊 Panel administrativo

## 🛠️ Tecnologías

### Frontend
- HTML5
- CSS3 (Bootstrap 5.3.3)
- JavaScript (ES6+)
- Font Awesome 6.4.2
- Bootstrap Icons

### Backend
- PHP 8.0+
- MySQL 8.0+
- PDO para acceso a base de datos

### Seguridad
- Variables de entorno para credenciales
- Tokens CSRF
- Sanitización XSS
- Rate limiting en login
- Password hashing con bcrypt
- Sesiones seguras

## 📦 Instalación

### Requisitos Previos

- PHP 8.0 o superior
- MySQL 8.0 o superior
- Servidor web (Apache/Nginx)
- Composer (opcional, para futuras dependencias)

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/tu-usuario/webonlineIUB.git
cd webonlineIUB
```

2. **Configurar la base de datos**
```bash
# Crear la base de datos
mysql -u root -p -e "CREATE DATABASE webonline CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"

# Importar el esquema inicial
mysql -u root -p webonline < BD/webonline.sql

# Ejecutar migraciones de seguridad
mysql -u root -p webonline < BD/migration_001_security_fixes.sql
```

3. **Configurar variables de entorno**
```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Editar .env con tus credenciales
nano .env
```

4. **Configurar permisos**
```bash
# Linux/Mac
chmod 755 matriculate-online/
chmod 644 .env

# Asegurar que .env no sea accesible públicamente
# Agregar a .htaccess si usas Apache:
echo "deny from all" > .htaccess
```

5. **Configurar servidor web**

**Apache (.htaccess ya incluido)**
```apache
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [L,QSA]
```

**Nginx**
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

## ⚙️ Configuración

### Archivo .env

Configurar las siguientes variables en `.env`:

```env
# CONFIGURACIÓN DE BASE DE DATOS
DB_HOST=localhost
DB_NAME=webonline
DB_USER=tu_usuario
DB_PASS=tu_contraseña_segura
DB_CHARSET=utf8mb4

# CONFIGURACIÓN DE SESIÓN
SESSION_LIFETIME=7200

# CONFIGURACIÓN DE SEGURIDAD
CSRF_TOKEN_NAME=csrf_token
HASH_ALGO=bcrypt

# AMBIENTE
APP_ENV=production  # development o production
APP_DEBUG=false     # true solo en desarrollo

# URL BASE
BASE_URL=https://tu-dominio.com
```

### Crear Usuario Administrador

```sql
-- Crear usuario administrador
INSERT INTO usuarios (usuario, correo, contrasena, tipo) 
VALUES ('admin', 'admin@bolivariano.edu.ec', '$2y$10$...', 'A');

-- El hash debe generarse con:
-- password_hash('tu_contraseña', PASSWORD_BCRYPT)
```

## 🎯 Uso

### Acceso al Sistema

**Portal Principal**: `http://tu-dominio.com/`

**Login Matrícula**: `http://tu-dominio.com/matriculate-online.php`

**Credenciales de prueba**:
- Usuario estudiante: `eric123` / contraseña definida en BD
- Usuario admin: `admin` / contraseña definida en BD

### Componentes Reutilizables (PHP)

```php
<?php
// Incluir en tus páginas PHP
$pageTitle = "Mi Página";
include 'components/header.php';
include 'components/nav.php';
?>

<!-- Tu contenido aquí -->

<?php
include 'components/footer.php';
?>
```

### Sistema de Notificaciones Toast

```javascript
// Mostrar notificaciones
toast.success('Operación exitosa');
toast.error('Ha ocurrido un error');
toast.warning('Advertencia importante');
toast.info('Información general');

// Confirmación
toast.confirm('¿Estás seguro?', 
    () => console.log('Confirmado'),
    () => console.log('Cancelado')
);
```

```php
<?php
// Desde PHP
require_once 'php-bd/toast-helper.php';

// Mostrar y redirigir
ToastHelper::redirect('../perfil.php', 'Datos actualizados', 'success');

// Solo mostrar
echo ToastHelper::success('Operación exitosa');
?>
```

## ✅ Checklist de Publicación (Pre-Producción)

Usa este checklist antes de desplegar cambios a producción.

### 1) Verificación funcional (rutas críticas)

- [ ] Home carga correctamente: `/`
- [ ] Admisiones: `/admisiones`
- [ ] Oferta académica: `/oferta-academica`
- [ ] Formación continua: `/formacion-continua`
- [ ] Metodología: `/metodologia-estudio`
- [ ] FAQ: `/faq`
- [ ] Eventos: `/eventos/evento1`, `/eventos/evento2`, `/eventos/evento3`
- [ ] Carreras (muestra): `/carreras/universitarias/admempresas`, `/carreras/diplomados/gestion-proyectos`
- [ ] Matrícula online: `/matriculate-online`

### 2) Redirecciones legacy

- [ ] URLs antiguas `.html` redirigen a rutas limpias (HTTP 301)
- [ ] `matriculate-online.php` redirige al flujo activo de matrícula
- [ ] No hay enlaces internos apuntando a archivos legacy

### 3) UX / UI y accesibilidad

- [ ] Navegación desktop y móvil usable en páginas públicas
- [ ] Contraste de texto adecuado en hero, botones y enlaces
- [ ] Foco visible con teclado (`Tab`) en enlaces, botones e inputs
- [ ] Botones/acciones con tamaño táctil suficiente (mínimo recomendado 44px)
- [ ] Formularios muestran feedback de validación correctamente

### 4) SEO y rastreo

- [ ] `sitemap.xml` contiene rutas limpias actualizadas
- [ ] `robots.txt` bloquea carpetas sensibles y legado (`proyecto old`)
- [ ] Títulos y meta descripción presentes en páginas principales

### 5) Seguridad y estructura

- [ ] `.env` no versionado
- [ ] Carpetas internas no públicas bloqueadas por `.htaccess`
- [ ] Carpeta legacy `proyecto old/` ignorada en Git
- [ ] Sin errores de sintaxis PHP (`php -l`)

### 6) Comandos rápidos de validación (PowerShell)

```powershell
# Sintaxis PHP (ejemplo)
php -l app/Config/Routes.php
php -l app/Controllers/PageController.php
php -l app/Views/layouts/main.php

# Levantar servidor MVC local
php -S 127.0.0.1:8099 public/index.php

# Smoke test básico de rutas
$urls = @('/','/admisiones','/oferta-academica','/faq','/eventos/evento1','/matriculate-online')
foreach ($u in $urls) {
    try {
        $r = Invoke-WebRequest -Uri ('http://127.0.0.1:8099' + $u) -MaximumRedirection 5 -UseBasicParsing
        Write-Output ($u + ' -> ' + [int]$r.StatusCode)
    } catch {
        Write-Output ($u + ' -> ERROR')
    }
}
```

### Criterio de salida para desplegar

- ✅ Todas las rutas críticas responden `200`
- ✅ Redirecciones legacy responden `301`
- ✅ Sin errores de sintaxis
- ✅ Navegación y formularios probados en móvil y desktop

## 🚀 Mejoras Implementadas

### Seguridad (CRÍTICO) ✅
- ✅ Variables de entorno para credenciales de BD
- ✅ Corrección tabla usuarios (campo 'tipo')
- ✅ Sanitización XSS en todas las salidas
- ✅ Protección CSRF en formularios
- ✅ Rate limiting en login (5 intentos)
- ✅ Bloqueo temporal de cuentas
- ✅ Logging de actividades
- ✅ Mensajes de error corregidos

### Base de Datos ✅
- ✅ Foreign keys para integridad referencial
- ✅ Índices optimizados
- ✅ Timestamps de auditoría
- ✅ Tabla de sesiones
- ✅ Tabla de logs de actividad
- ✅ Vista de usuarios completos

### SEO & Performance ✅
- ✅ Meta tags completos (Open Graph, Twitter Cards)
- ✅ Schema.org markup
- ✅ Lazy loading de imágenes
- ✅ Atributos width/height en imágenes
- ✅ Alt text descriptivos
- ✅ Canonical URLs

### UX/UI ✅
- ✅ Toast notifications modernas
- ✅ Componentes reutilizables PHP
- ✅ Página activa resaltada en navegación
- ✅ Mensajes de error/éxito mejorados

### Arquitectura ✅
- ✅ Helpers de seguridad
- ✅ Helper de toast
- ✅ Cargador de variables de entorno
- ✅ Componentes modulares
- ✅ Separación de responsabilidades

## 📁 Estructura del Proyecto

```
webonlineIUB/
├── .env                    # Variables de entorno (NO versionar)
├── .env.example            # Plantilla de variables
├── .gitignore              # Archivos ignorados por git
├── index.html              # Página principal
├── matriculate-online.php  # Login matrícula
├── assets/
│   ├── fonts/
│   ├── images/
│   └── videos/
├── BD/
│   ├── webonline.sql                      # Esquema inicial
│   └── migration_001_security_fixes.sql   # Migración seguridad
├── carreras/
│   ├── diplomados/
│   └── universitarias/
├── css/
│   ├── style.css
│   ├── toast.css           # Estilos toast
│   └── bootstrap.css
├── js/
│   ├── main.js
│   └── toast.js            # Sistema toast
├── matriculate-online/
│   ├── components/
│   │   ├── header.php      # Header reutilizable
│   │   ├── nav.php         # Navegación reutilizable
│   │   └── footer.php      # Footer reutilizable
│   ├── php-bd/
│   │   ├── conexion.php             # Conexión BD
│   │   ├── env-loader.php           # Cargador .env
│   │   ├── security-helper.php      # Utilidades seguridad
│   │   ├── toast-helper.php         # Helper toast
│   │   ├── login.php                # Login mejorado
│   │   ├── obtener_datos.php
│   │   └── actualizar_datosP.php    # Actualización perfil
│   ├── administrador/
│   └── css/
└── eventos/
```

## 🔒 Seguridad

### Buenas Prácticas Implementadas

1. **Nunca versionar `.env`** - Contiene credenciales sensibles
2. **Usar HTTPS en producción** - Encrypt todas las comunicaciones
3. **Actualizar dependencias regularmente**
4. **Backups periódicos de BD**
5. **Monitorear logs de actividad**
6. **Revisar intentos de login fallidos**

### Checklist de Seguridad

- [x] Credenciales en variables de entorno
- [x] Prepared statements (PDO)
- [x] Password hashing (bcrypt)
- [x] Validación de entrada
- [x] Sanitización de salida
- [x] Protección CSRF
- [x] Protección XSS
- [x] Rate limiting
- [x] Logging de actividades
- [ ] HTTPS (configurar en servidor)
- [ ] Firewall de aplicación web
- [ ] Backups automáticos

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Changelog

### Version 2.1.0 (2026-03-06)

**Arquitectura MVC**
- Migración completa a MVC propio (PHP 8.1+): `public/index.php`, `app/Config/Routes.php`, Controllers, Views
- Layout base con Bootstrap 5.3, Font Awesome 6.4, Bootstrap Icons
- `.htaccess` con rewrite a entrypoint MVC; archivos reales servidos directamente

**Página de Inicio — Rediseño Completo**
- Header sticky, menú desktop/mobile full-width
- Carrusel full-width sin recorte de imagen
- Sección programas en grid proporcional (3 columnas)
- Sección eventos en grid, accesos directos, footer modernos
- Fix: `main.ux-page-shell → max-width: 100%` (elimina márgenes blancos)

**Módulo Matrícula**
- Login dedicado sin `alert()`, errores via session flash
- XSS corregido, CSRF en todos los forms, `components/nav.php` en todas las páginas
- Estado Civil como `<select>`, fecha de nacimiento como `type="date"`
- Último pago dinámico desde BD

**Fixes**
- HTML inválido corregido en home
- 404 con página HTML completa en el router
- `robots.txt` y `sitemap.xml` actualizados

### Version 2.0.0 (2026-03-04)

**Seguridad**
- Implementadas variables de entorno
- Agregado sistema de protección CSRF
- Sanitización XSS completa
- Rate limiting en login
- Logging de actividades

**Features**
- Sistema de toast notifications
- Componentes PHP reutilizables
- Meta tags SEO completos
- Lazy loading de imágenes

**Base de Datos**
- Migraciones de seguridad
- Foreign keys
- Índices optimizados
- Tablas de auditoría

**Fixes**
- Corregidos mensajes de error
- Mejorada estructura de BD
- Optimizado rendimiento

### Version 1.0.0 (2024-07-16)
- Release inicial

## � Documentación Completa

El proyecto cuenta con documentación exhaustiva organizada por propósito:

### 📖 Documentación Técnica
- **[README.md](README.md)** - Este archivo, documentación principal
- **[INICIO-RAPIDO.md](INICIO-RAPIDO.md)** - Guía de inicio rápido para nuevos desarrolladores
- **[IMPLEMENTACION-COMPLETA.md](IMPLEMENTACION-COMPLETA.md)** - Resumen de Fases 1 y 2 completadas
- **[CAMBIOS.md](CAMBIOS.md)** - Registro detallado de todos los cambios

### 🗺️ Planificación y Roadmap
- **[ROADMAP.md](ROADMAP.md)** - Hoja de ruta completa del proyecto con todas las fases
- **[TODO.md](TODO.md)** - Lista exhaustiva de tareas pendientes organizadas por prioridad
- **[PLAN-MANANA.md](PLAN-MANANA.md)** - Plan detallado para el próximo día de trabajo

### 🏗️ Arquitectura y Diseño
- **[ESTRUCTURA-PROPUESTA.md](ESTRUCTURA-PROPUESTA.md)** - Nueva arquitectura MVC propuesta
- **[MODULO-ADMIN-SPECS.md](MODULO-ADMIN-SPECS.md)** - Especificaciones completas del módulo administrativo

### 📊 Estado del Proyecto

**Versión Actual:** 2.1.0 (Producción)
**Fases Completadas:** 3/6 (50%)
**Próxima Fase:** Módulo Administrativo

```
Fase 1: Seguridad y UX Base        ████████████████████ 100% ✅
Fase 2: Funcionalidades Avanzadas  ████████████████████ 100% ✅
Fase 3: Reestructuración MVC       ████████████████████ 100% ✅
Fase 4: Módulo Administrativo      ░░░░░░░░░░░░░░░░░░░░   0% 🔄 PRÓXIMO
Fase 5: Optimización               ░░░░░░░░░░░░░░░░░░░░   0% 📅
Fase 6: Expansión                  ░░░░░░░░░░░░░░░░░░░░   0% 💡
```

### 🎯 Próximas Prioridades (Ver [PLAN-MANANA.md](PLAN-MANANA.md))

1. **Reestructuración MVC** (~8.5 horas)
   - Crear estructura de carpetas profesional
   - Implementar autoloading PSR-4
   - Sistema de routing moderno
   - Separación de concerns

2. **Módulo Administrativo** (~20 horas)
   - Dashboard con métricas y gráficos
   - Gestión completa de usuarios
   - Aprobación de documentos
   - Gestión financiera
   - Sistema de roles y permisos

3. **Optimización** (~27.5 horas)
   - Implementar caché
   - Optimización SQL
   - PWA y service workers
   - Testing automatizado

### 📈 Métricas de Mejora

| Aspecto | Antes | Después | Mejora |
|---------|-------|---------|--------|
| **Seguridad** | 2/10 | 9/10 | +350% |
| **SEO** | 3/10 | 9/10 | +200% |
| **UX** | 5/10 | 9/10 | +80% |
| **Performance** | 6/10 | 8/10 | +33% |
| **Code Quality** | 4/10 | 8/10 | +100% |

### 🚀 Funcionalidades Implementadas

**Fase 1 - Seguridad y UX Base**
- ✅ Variables de entorno
- ✅ Sanitización XSS
- ✅ Protección CSRF
- ✅ Toast notifications
- ✅ Meta tags SEO
- ✅ Componentes reutilizables

**Fase 2 - Funcionalidades Avanzadas**
- ✅ Modo oscuro
- ✅ Sistema de uploads con validación
- ✅ Generación de PDFs
- ✅ FAQ interactivo
- ✅ Breadcrumbs
- ✅ Sitemap y robots.txt

**Total de archivos creados:** 30  
**Total de líneas de código agregadas:** ~6,000

Para más detalles, consulta [IMPLEMENTACION-COMPLETA.md](IMPLEMENTACION-COMPLETA.md)

## �📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 👥 Autores

- **Robert Ocampo** - *Desarrollo Inicial* - Corp. Simtelec
- **Eric Alvarado** - *Módulo Matrícula Online*

## 📞 Soporte

Para soporte técnico:
- Email: info@tbolivariano.edu.ec
- Teléfono: +593 72 575 245
- Sitio web: [https://tbolivariano.edu.ec](https://tbolivariano.edu.ec)

## 🙏 Agradecimientos

- Instituto Superior Universitario Bolivariano
- Corp. Simtelec
- Comunidad de desarrolladores PHP

---

**Desarrollado con ❤️ por Corp. Simtelec para Instituto Superior Universitario Bolivariano**

**Última actualización:** 2026-03-06 | **Versión:** 2.1.0
