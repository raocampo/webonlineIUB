<?php declare(strict_types=1); ?>

<style>
/* =========================================
   HOME PAGE — OVERRIDES Y REDISEÑO COMPLETO
   ========================================= */

/* 0. Rompe el contenedor max-width del layout — todo full-width */
main.ux-page-shell {
  max-width: 100% !important;
  width: 100% !important;
  padding: 0 !important;
  overflow-x: hidden;
}

/* 1. HEADER sticky, auto-height, moderno */
.hero {
  position: sticky !important;
  top: 0 !important;
  height: auto !important;
  margin-bottom: 0 !important;
  background-image: none !important;
  background-color: #fff !important;
  border-bottom: 2px solid #e0e6f0;
  box-shadow: 0 2px 12px rgba(29,50,123,0.1);
  z-index: 1000;
  padding: 0 !important;
}

.logo-hero {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  padding: 0.75rem 1.5rem !important;
  max-width: 1440px;
  margin: 0 auto;
  width: 100%;
}
.logo-hero img {
  width: auto !important;
  height: 48px !important;
  display: block;
}
.logo-hero a {
  display: flex;
  align-items: center;
}

/* 2. MENÚ DESKTOP */
.menu {
  background-color: #1D327B !important;
  margin-top: 0 !important;
}
.sub-menu {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 0.25rem;
  padding: 0 1rem !important;
  max-width: 1440px;
  margin: 0 auto;
  list-style: none;
  flex-wrap: wrap;
}
.sub-menu > ul {
  display: flex;
  align-items: center;
  gap: 0.1rem;
  list-style: none;
  padding: 0;
  margin: 0;
  flex-wrap: wrap;
  justify-content: center;
}
.sub-menu a {
  color: #fff !important;
  font-size: 0.82rem !important;
  font-weight: 700 !important;
  padding: 0.75rem 0.9rem !important;
  display: flex !important;
  align-items: center !important;
  gap: 0.25rem;
  text-decoration: none !important;
  border-bottom: none !important;
  line-height: 1.2 !important;
  margin-top: 0 !important;
  white-space: nowrap;
  border-radius: 4px;
  transition: background-color 0.2s;
}
.sub-menu a:hover {
  background-color: rgba(255,255,255,0.15) !important;
  border-bottom: none !important;
  color: #FFE900 !important;
  font-size: 0.82rem !important;
}
/* Submenú desplegable */
.navbar .dropdown1 ul,
.navbar .dropdown ul {
  top: 100% !important;
  left: 0 !important;
  background: #fff !important;
  border-radius: 8px !important;
  box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
  padding: 0.5rem 0 !important;
  min-width: 220px !important;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.2s, visibility 0.2s;
}
.navbar .dropdown1:hover > ul,
.navbar .dropdown:hover > ul {
  opacity: 1 !important;
  visibility: visible !important;
  top: 100% !important;
}
.navbar .dropdown1 ul a,
.navbar .dropdown ul a {
  color: #1D327B !important;
  font-weight: 600 !important;
  font-size: 0.85rem !important;
  padding: 0.6rem 1rem !important;
  display: block !important;
  border-radius: 0 !important;
  border-bottom: none !important;
}
.navbar .dropdown1 ul a:hover,
.navbar .dropdown ul a:hover {
  background: #f0f4ff !important;
  color: #1D327B !important;
}
.navbar .dropdown1 ul li,
.navbar .dropdown ul li {
  min-width: unset !important;
  list-style: none;
}

/* 3. MENÚ MOBILE */
.menu-mobile {
  background-color: #1D327B;
  padding: 0.5rem 1rem;
}
.menu-icon {
  color: #fff !important;
  font-size: 2rem !important;
}
.menu-mobile-items {
  background: #1D327B !important;
  top: auto !important;
  position: static !important;
  transform: none !important;
  height: auto !important;
  width: 100% !important;
  display: none !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  padding: 1rem !important;
  gap: 0.5rem !important;
}
.menu_checkbox:checked ~ .menu-mobile-items {
  display: flex !important;
}
.menu-mobile-items li {
  width: 100%;
}
.menu-mobile-items a {
  color: #fff !important;
  font-size: 1rem !important;
  font-weight: 600;
  padding: 0.5rem 1rem;
  display: block;
  border-radius: 6px;
}
.menu-mobile-items a:hover {
  background: rgba(255,255,255,0.1);
  color: #FFE900 !important;
}
.menu-mobile-items ul {
  display: none !important; /* submenu mobile oculto por defecto */
  padding-left: 1rem;
  list-style: none;
}

/* 4. HERO BAND (ux-home-hero) */
.ux-home-hero {
  background: linear-gradient(135deg, #1D327B 0%, #2748b1 60%, #1a5276 100%) !important;
  border-bottom: none !important;
  padding: 0 !important;
}
.ux-home-hero__content {
  max-width: 900px !important;
  margin: 0 auto !important;
  padding: 3.5rem 2rem 3.5rem !important;
  text-align: center;
}
.ux-home-hero__badge {
  background: rgba(255,255,255,0.15) !important;
  color: #FFE900 !important;
  margin-bottom: 1rem;
  display: inline-flex;
}
.ux-home-hero h1 {
  color: #fff !important;
  font-size: clamp(1.6rem, 3.5vw, 2.8rem) !important;
  margin: 0.75rem 0 !important;
  line-height: 1.2 !important;
  font-weight: 800;
}
.ux-home-hero p {
  color: rgba(255,255,255,0.88) !important;
  font-size: 1.05rem !important;
  max-width: 680px;
  margin: 0 auto 1.5rem !important;
  line-height: 1.7;
}
.ux-home-hero__actions {
  justify-content: center !important;
}
.ux-btn--primary {
  background: #FFE900 !important;
  color: #1D327B !important;
  font-weight: 800 !important;
}
.ux-btn--primary:hover {
  background: #ffd700 !important;
  color: #1D327B !important;
}
.ux-btn--light {
  background: transparent !important;
  color: #fff !important;
  border: 2px solid rgba(255,255,255,0.6) !important;
}
.ux-btn--light:hover {
  background: rgba(255,255,255,0.1) !important;
  color: #FFE900 !important;
  border-color: #FFE900 !important;
}

/* 5. CARRUSEL — full width, altura fija */
.sub-hero {
  margin-top: 0 !important;
  height: auto !important;
  overflow: hidden;
  line-height: 0;
}
.carrusel {
  width: 100% !important;
  height: auto !important;
}
#carouselExampleCaptions {
  width: 100%;
}
#carouselExampleCaptions .carousel-inner {
  width: 100%;
}
#carouselExampleCaptions .carousel-item img {
  width: 100% !important;
  height: auto !important;
  object-fit: contain !important;
  display: block;
  background: #000;
}

/* 6. SECCIÓN PROGRAMAS (metodo) */
.img-admindex {
  margin-top: 0 !important;
  overflow: visible !important;
}
.metodo {
  min-width: 0 !important;
  width: 100% !important;
  height: auto !important;
  margin-top: 0 !important;
  background-color: #1D327B !important;
  background-image: none !important;
  padding: 4rem 1rem !important;
}
.contenido-metodo {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 2rem !important;
  width: 100% !important;
  max-width: 1200px;
  margin: 0 auto !important;
  padding: 0 1rem !important;
}
@media (max-width: 768px) {
  .contenido-metodo { grid-template-columns: 1fr !important; }
}
.metodologia {
  width: 100% !important;
  flex: unset !important;
  font-size: 1rem !important;
  line-height: 1.4 !important;
  padding: 2rem 1.5rem !important;
  background: rgba(255,255,255,0.1);
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,0.2);
  transition: transform 0.2s, background 0.2s;
  color: #fff !important;
  margin-top: 0 !important;
}
.metodologia:hover {
  transform: translateY(-6px);
  background: rgba(255,255,255,0.18);
}
.metodologia img {
  width: 120px !important;
  height: 120px !important;
  object-fit: contain;
  margin: 0 auto 1.25rem !important;
  display: block;
}
.metodologia h2 {
  color: #FFE900 !important;
  font-size: 1.1rem !important;
  font-weight: 700 !important;
  margin: 0 !important;
  line-height: 1.3 !important;
  text-align: center;
}
.metodologia a {
  text-decoration: none;
  color: inherit;
}

/* 7. SECCIÓN CARACTERÍSTICAS */
.botones {
  background-color: #f4f7ff !important;
  height: auto !important;
  padding: 3.5rem 1rem !important;
}
.botones h4 {
  font-size: 1.1rem !important;
}
.sub-botones {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: wrap !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 1.5rem !important;
  height: auto !important;
  max-width: 900px;
  margin: 0 auto !important;
  padding: 0 !important;
  cursor: default;
}
.acceso, .mencion {
  width: 180px !important;
  height: 180px !important;
  background-image: none !important;
  background-color: #fff !important;
  border: 2px solid #dce6ff !important;
  border-radius: 16px !important;
  padding: 1.5rem !important;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 16px rgba(29,50,123,0.08) !important;
  transition: transform 0.2s, box-shadow 0.2s !important;
}
.horario, .online {
  width: 180px !important;
  height: 180px !important;
  background-image: none !important;
  background-color: #1D327B !important;
  border-radius: 16px !important;
  padding: 1.5rem !important;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 16px rgba(29,50,123,0.2) !important;
  transition: transform 0.2s, box-shadow 0.2s !important;
}
.acceso:hover, .mencion:hover, .horario:hover, .online:hover {
  transform: translateY(-4px) !important;
  box-shadow: 0 8px 24px rgba(29,50,123,0.15) !important;
}
.acceso img, .mencion img, .horario img {
  width: 60px !important;
  height: 60px !important;
  object-fit: contain;
  margin-bottom: 0.75rem !important;
}
.acceso-texto, .mencion-texto {
  color: #1D327B !important;
  font-weight: 700;
  font-size: 0.85rem !important;
  line-height: 1.2 !important;
}
.horario-texto {
  color: #fff !important;
  font-weight: 700;
  font-size: 0.85rem !important;
  line-height: 1.2 !important;
}
.mencion-online span {
  font-size: 2.5rem !important;
  font-weight: 800;
  color: #FFE900 !important;
}
.mencion-online p {
  font-size: 1.2rem !important;
  color: #fff !important;
  font-weight: 700;
  line-height: 1.2 !important;
  margin: 0;
}
.online p {
  color: #fff !important;
  font-size: 1rem !important;
}
/* Ocultar hover overlays que no funcionan bien */
.acceso-hover-text,
.horario-hover-text,
.mencion-hover-text,
.online-hover-text {
  display: none !important;
}

/* 8. SECCIÓN EVENTOS */
.eventos {
  padding: 4rem 1.5rem !important;
  background: #fff;
}
.eventos h2 {
  color: #1D327B !important;
  font-size: 1.8rem !important;
  font-weight: 800;
  text-align: center;
  margin-bottom: 2rem !important;
  position: relative;
}
.eventos h2::after {
  content: '';
  display: block;
  width: 60px;
  height: 4px;
  background: #FFE900;
  margin: 0.5rem auto 0;
  border-radius: 2px;
}
.tarjeta {
  max-width: 1100px;
  margin: 0 auto !important;
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 1.5rem !important;
}
@media (max-width: 900px) {
  .tarjeta { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 580px) {
  .tarjeta { grid-template-columns: 1fr !important; }
}
.tarjeta-evento {
  overflow: hidden;
  border-radius: 12px !important;
  background: #fff;
  box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
  transition: transform 0.2s, box-shadow 0.2s;
  border: 1px solid #e0e6f0 !important;
}
.tarjeta-evento:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 28px rgba(29,50,123,0.13) !important;
}
.tarjeta-evento img {
  height: 200px !important;
  object-fit: cover !important;
  border-radius: 0 !important;
}
.tarjeta-evento h4 {
  color: #1D327B !important;
  font-size: 0.95rem !important;
  font-weight: 700;
  padding: 1rem 1rem 1.25rem !important;
  line-height: 1.45;
  margin: 0 !important;
}
.tarjeta-evento a {
  display: block;
  text-decoration: none !important;
}
.tarjeta-evento img:hover {
  transform: none !important;
}

/* 9. ACCESOS DIRECTOS */
.accesodirecto {
  background-color: #1D327B !important;
  height: auto !important;
  padding: 3.5rem 1.5rem !important;
  text-align: center !important;
}
.accesodirecto h3 {
  color: #fff !important;
  font-size: 1.5rem !important;
  font-weight: 700;
  margin-bottom: 2rem;
  padding: 0 !important;
}
.accesodirecto-menu ul {
  list-style: none !important;
  display: flex !important;
  flex-wrap: wrap !important;
  justify-content: center !important;
  gap: 2.5rem !important;
  width: auto !important;
  max-width: 800px;
  margin: 0 auto;
}
.accesodirecto-menu ul li {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 0.5rem !important;
  width: auto !important;
  margin: 0 !important;
}
.accesodirecto-menu li:last-child {
  grid-column: unset !important;
}
.accesodirecto-menu ul li i {
  font-size: 2.5rem !important;
  color: #FFE900 !important;
  display: block;
}
.accesodirecto-menu ul li a {
  color: #fff !important;
  font-size: 0.9rem !important;
  font-weight: 600;
  line-height: 1.3 !important;
  text-decoration: none !important;
  display: block !important;
}
.accesodirecto-menu ul li a:hover {
  color: #FFE900 !important;
}

/* 10. FORMULARIO POSTULACIÓN */
.registro-online {
  width: 100% !important;
  max-width: 560px !important;
  height: auto !important;
  margin: 0 auto !important;
  padding: 3rem 1.5rem !important;
  background: #f4f7ff;
}
.registro-online h3 {
  color: #1D327B !important;
  font-size: 1.6rem !important;
  font-weight: 800;
  margin-bottom: 1.5rem !important;
}
.registro-online form {
  background: #fff !important;
  border-radius: 12px !important;
  padding: 2rem !important;
  box-shadow: 0 4px 16px rgba(29,50,123,0.08) !important;
  gap: 1rem !important;
}
.registro-online label {
  color: #333 !important;
  font-weight: 600;
  font-size: 0.9rem !important;
}
.registro-online input,
.registro-online select {
  width: 100%;
  padding: 0.6rem 0.9rem !important;
  border: 1.5px solid #dee2e6 !important;
  border-radius: 8px !important;
  font-size: 0.95rem;
  transition: border-color 0.2s;
  background: #fff;
}
.registro-online input:focus,
.registro-online select:focus {
  border-color: #1D327B !important;
  outline: none;
  box-shadow: 0 0 0 3px rgba(29,50,123,0.1);
}
.btnenviarindex {
  width: auto !important;
  background-color: #1D327B !important;
  color: #FFE900 !important;
  font-weight: 700 !important;
  padding: 0.75rem 2rem !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  margin: 0.5rem auto 0 !important;
  display: block !important;
  cursor: pointer;
  border: none;
  transition: background 0.2s !important;
}
.btnenviarindex:hover {
  background-color: #152459 !important;
  color: #FFE900 !important;
}

/* 11. FOOTER */
footer {
  margin-top: 0 !important;
  background-color: #0f1f54 !important;
  padding: 2.5rem 1.5rem !important;
}
.direccion {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
  align-items: flex-start;
  max-width: 1000px;
  margin: 0 auto 1.5rem !important;
  text-align: left !important;
}
.direccion-contenido {
  min-width: 220px;
}
.direccion h6 {
  font-size: 1.05rem !important;
  font-weight: 700;
  color: #FFE900 !important;
  margin-bottom: 0.75rem;
}
.direccion p {
  color: rgba(255,255,255,0.85) !important;
  font-size: 0.9rem !important;
  line-height: 1.8 !important;
  text-align: left !important;
}
.fa-location-dot, .fa-phone-volume, .fa-mobile, .fa-envelope {
  margin-right: 0.5rem !important;
  color: #FFE900;
}
.mapa iframe {
  border-radius: 10px;
  max-width: 100%;
}
.footer-fin {
  border-top: 1px solid rgba(255,255,255,0.15) !important;
  margin-top: 1.5rem !important;
  padding-top: 1.5rem;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}
.iconos {
  display: flex !important;
  align-items: center !important;
  font-size: 1.5rem !important;
  gap: 1rem !important;
  margin-top: 0 !important;
}
.iconos a { color: rgba(255,255,255,0.7); }
.iconos a:hover {
  color: #FFE900 !important;
  font-size: 1.5rem !important;
  padding: 0 !important;
}
.texto-footer {
  color: rgba(255,255,255,0.6) !important;
  font-size: 0.8rem !important;
  margin-top: 0 !important;
}
.texto-footer span { color: rgba(255,255,255,0.8); }

/* Responsive */
@media (max-width: 768px) {
  .logo-hero { padding: 0.6rem 1rem !important; }
  .logo-hero img { height: 36px !important; }
  .menu { display: none !important; }
  .menu-mobile { display: block !important; }
  .metodologia { width: 150px !important; flex: 0 1 150px !important; }
  .acceso, .mencion, .horario, .online { width: 140px !important; height: 140px !important; }
  .accesodirecto-menu ul { gap: 1.5rem !important; }
  .footer-fin { justify-content: center; text-align: center; }
}
@media (min-width: 769px) {
  .menu-mobile { display: none !important; }
}
</style>

<header class="hero">
    <div class="logo-hero">
        <a href="https://tbolivariano.edu.ec" target="_blank" rel="noopener">
            <img src="/assets/images/logos/Bolivariano.png" alt="Logo Instituto Universitario Bolivariano" height="48">
        </a>
        <img src="/assets/images/logos/BolOnline.png" alt="Logo Bolivariano Online" height="48">
    </div>

    <div class="menu">
        <nav class="sub-menu text-center contenedor navbar" aria-label="Navegación principal">
            <ul>
                <li class="dropdown1">
                    <a href="/admisiones">ADMISIONES <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/oferta-academica">Carreras Universitarias</a></li>
                        <li><a href="/formacion-continua">Formación Continua</a></li>
                        <li><a href="/formacion-continua">Posgrados</a></li>
                    </ul>
                </li>
                <li><a href="/oferta-academica">OFERTA ACADÉMICA</a></li>
                <li><a href="/matriculate-online">MATRICÚLATE ONLINE</a></li>
                <li><a href="/metodologia-estudio">METODOLOGÍA</a></li>
                <li><a href="https://bolivarianovirtual.com/login/index.php" target="_blank" rel="noopener">EVA ONLINE</a></li>
            </ul>
        </nav>
    </div>

    <div class="menu-mobile">
        <label for="check" class="menu-icon" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </label>
        <input type="checkbox" id="check" class="menu_checkbox" aria-hidden="true">
        <ul class="menu-mobile-items">
            <li><a href="/admisiones">ADMISIONES</a></li>
            <li><a href="/oferta-academica">OFERTA ACADÉMICA</a></li>
            <li><a href="/matriculate-online">MATRICÚLATE ONLINE</a></li>
            <li><a href="/metodologia-estudio">METODOLOGÍA</a></li>
            <li><a href="https://bolivarianovirtual.com/login/index.php" target="_blank" rel="noopener">EVA ONLINE</a></li>
        </ul>
    </div>
</header>

<section class="ux-home-hero">
    <div class="ux-home-hero__content">
        <p class="ux-home-hero__badge"><i class="bi bi-mortarboard-fill"></i> Educación superior 100% en línea</p>
        <h1>Impulsa tu futuro profesional con Bolivariano Online</h1>
        <p>Estudia con horarios flexibles, docentes especializados y acompañamiento académico permanente desde cualquier lugar del país.</p>
        <div class="ux-home-hero__actions">
            <a href="/oferta-academica" class="ux-btn ux-btn--primary">Ver Oferta Académica</a>
            <a href="/matriculate-online" class="ux-btn ux-btn--light">Matricúlate Ahora</a>
        </div>
    </div>
</section>

<section class="sub-hero" aria-label="Galería institucional">
    <div class="carrusel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/assets/images/Carrusel/inicial.png" class="d-block w-100" alt="Bienvenido a Bolivariano Online">
                </div>
                <div class="carousel-item">
                    <img src="/assets/images/Carrusel/convenciones.png" class="d-block w-100" alt="Convenciones académicas" loading="lazy">
                </div>
                <div class="carousel-item">
                    <img src="/assets/images/Carrusel/bibliotecaVirtual.png" class="d-block w-100" alt="Biblioteca Virtual" loading="lazy">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>

<section class="img-admindex metodo" aria-label="Nuestros programas">
    <div class="contenido-metodo">
        <div class="metodologia text-center">
            <a href="/oferta-academica">
                <img src="/assets/images/carrerasUniversitarias.png" alt="Carreras Universitarias" loading="lazy">
                <h2>CARRERAS UNIVERSITARIAS</h2>
            </a>
        </div>
        <div class="metodologia text-center">
            <a href="/oferta-academica">
                <img src="/assets/images/posgrado.PNG" alt="Posgrados" loading="lazy">
                <h2>POSGRADOS</h2>
            </a>
        </div>
        <div class="metodologia text-center">
            <a href="/formacion-continua">
                <img src="/assets/images/formacionContinua.png" alt="Formación Continua" loading="lazy">
                <h2>FORMACIÓN CONTINUA</h2>
            </a>
        </div>
    </div>
</section>

<section class="botones" aria-label="Ventajas de estudiar con nosotros">
    <div class="sub-botones contenedor">
        <div id="acceso" class="acceso">
            <img class="acceso-img" src="/assets/images/computador.png" alt="Acceso 24/7" loading="lazy">
            <p class="acceso-texto">ACCESO 24/7</p>
            <p class="acceso-texto">365 DÍAS</p>
        </div>
        <div id="horario" class="horario">
            <img class="horario-img" src="/assets/images/reloj.png" alt="Horarios flexibles" loading="lazy">
            <p class="horario-texto">HORARIOS</p>
            <p class="horario-texto">FLEXIBLES</p>
        </div>
        <div id="obtiene" class="mencion">
            <img class="mencion-image" src="/assets/images/birrete.png" alt="Título universitario" loading="lazy">
            <p class="mencion-texto">MENCIÓN</p>
            <p class="mencion-texto">UNIVERSITARIA</p>
        </div>
        <div id="online" class="online">
            <div class="mencion-online">
                <span>100%</span>
                <p>ONLINE</p>
            </div>
        </div>
    </div>
</section>

<section class="eventos" aria-label="Noticias y eventos">
    <h2>EVENTOS</h2>
    <div class="tarjeta contenedor">
        <div class="tarjeta-evento">
            <a href="/eventos/evento1">
                <img src="/assets/images/eventos/evento1.png" alt="Bolivariano oferta carreras innovadoras" loading="lazy">
                <h4>Universitario Bolivariano oferta carreras innovadoras en línea</h4>
            </a>
        </div>
        <div class="tarjeta-evento">
            <a href="/eventos/evento2">
                <img src="/assets/images/eventos/evento2.png" alt="Bolivariano pionero en formación académica" loading="lazy">
                <h4>Universitario Bolivariano, pionero en la formación académica hacia el progreso</h4>
            </a>
        </div>
        <div class="tarjeta-evento">
            <a href="/eventos/evento3">
                <img src="/assets/images/eventos/evento3.png" alt="Bolivariano presenta siete carreras online" loading="lazy">
                <h4>Universitario Bolivariano presenta siete carreras online de vanguardia</h4>
            </a>
        </div>
    </div>
</section>

<section class="accesodirecto" aria-label="Accesos directos">
    <h3>ACCESOS DIRECTOS</h3>
    <div class="contenedor accesodirecto-icon">
        <div class="accesodirecto-menu">
            <ul>
                <li class="acceso1">
                    <i class="bi bi-calendar-check icon"></i>
                    <a href="https://tbolivariano.edu.ec" target="_blank" rel="noopener">Calendarios Académicos</a>
                </li>
                <li class="acceso2">
                    <i class="bi bi-pc-display icon"></i>
                    <a href="https://bolivarianovirtual.com/mod/url/view.php?id=83932" target="_blank" rel="noopener">Biblioteca Virtual</a>
                </li>
                <li class="acceso3">
                    <i class="bi bi-person-video3 icon"></i>
                    <a href="https://bolivarianovirtual.com" target="_blank" rel="noopener">Educación Online</a>
                </li>
                <li class="acceso4">
                    <i class="fa-regular fa-newspaper icon"></i>
                    <a href="https://bolivarianovirtual.com" target="_blank" rel="noopener">Boletín Semanal</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="registro-online" aria-label="Formulario de postulación">
    <h3 class="text-center">POSTULA ONLINE</h3>
    <form id="registroForm" action="registrar.php" method="post" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>

        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required>

        <label for="cedula">Número de Identificación</label>
        <input type="text" id="cedula" name="cedula" placeholder="0000000000" maxlength="13" required>

        <label for="telefono">Teléfono Móvil</label>
        <input type="tel" id="telefono" name="telefono" placeholder="0999 999 999" required>

        <label for="tipoEstudio">Tipo de Estudio</label>
        <select id="tipoEstudio" name="tipoEstudio" required>
            <option value="">Seleccione una opción</option>
            <option value="Pregrado">Pregrado</option>
            <option value="Formación Continua">Formación Continua</option>
        </select>

        <button class="btnenviarindex" onclick="sendToWhatsApp();" type="button">
            <i class="fab fa-whatsapp"></i> Enviar por WhatsApp
        </button>
    </form>
</section>

<footer>
    <div class="direccion">
        <div class="direccion-contenido">
            <h6>Instituto Universitario Bolivariano</h6>
            <p><i class="fa-solid fa-location-dot"></i>José A. Eguiguren entre Bolivar y Sucre, Loja</p>
            <p><i class="fa-solid fa-phone-volume"></i>593-072575245</p>
            <p><i class="fa-solid fa-envelope"></i>info@tbolivariano.edu.ec</p>
        </div>
        <div class="mapa">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d995.029451934456!2d-79.2037456!3d-3.9961929!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb48004b0462d3%3A0x39a0fac78bee059b!2sUniversitario%20Bolivariano%20Loja!5e0!3m2!1ses!2sec!4v1717618850928!5m2!1ses!2sec"
                width="360" height="220" style="border:0;" allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa Instituto Universitario Bolivariano Loja">
            </iframe>
        </div>
    </div>
    <div class="footer-fin">
        <div class="iconos">
            <a href="https://www.youtube.com/channel/UCL1pzhEf9Q5CT_Hp7cDvMiw" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            <a href="https://www.facebook.com/Instituto-Tecnol%C3%B3gico-Bolivariano-Loja-800671470025862/" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/universitariobolivarianoloja/?hl=es-la" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://twitter.com/BolivarianoLoja" target="_blank" rel="noopener" aria-label="Twitter/X"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/company/instituto-tecnol%C3%B3gico-bolivariano" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="texto-footer text-center">
            <p><span>Instituto Superior Universitario Bolivariano</span> &copy; <?= date('Y') ?></p>
            <p>Desarrollado por Corp. Simtelec</p>
        </div>
    </div>
</footer>
