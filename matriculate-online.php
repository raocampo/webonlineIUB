<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Robert Ocampo (R@0/CorpSimtelec)" />
  <meta name="description" content="Bolivariano Online" />
  <meta name="keywords" content="Bolivariano Online" />

  <!--Favicon / iconos-->
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/iconos/icono-32x32.png" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css"
    integrity="sha512-W/zrbCncQnky/EzL+/AYwTtosvrM+YG/V6piQLSe2HuKS6cmbw89kjYkp3tWFn1dkWV7L1ruvJyKbLz73Vlgfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/regular.min.css"
    integrity="sha512-rOTVxSYNb4+/vo9pLIcNAv9yQVpC8DNcFDWPoc+gTv9SLu5H8W0Dn7QA4ffLHKA0wysdo6C5iqc+2LEO1miAow=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/solid.min.css"
    integrity="sha512-P9pgMgcSNlLb4Z2WAB2sH5KBKGnBfyJnq+bhcfLCFusrRc4XdXrhfDluBl/usq75NF5gTDIMcwI1GaG5gju+Mw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Estilos-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/style.css">

  <title>Web Online Instituto Bolivariano</title>
</head>

<body>

  <header class="hero">
    <!--<img src="assets/images/fondoHeader.png" alt="fondo">-->
    <div class="logo-hero">
      <img src="assets/images/logos/Bolivariano.png" alt="logoBolivariano">
      <img src="assets/images/logos/BolOnline.png" alt="logoOnline">
    </div>

    <div class="menu">

      <nav class="sub-menu text-center contenedor navbar">
        <a href="index.html"><img src="assets/images/home.png" alt="iconoInicio"></a>
        <li class="dropdown"><a href="admisiones-iub.html">ADMISIONES<i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="oferta-academica.html">PREGRADO</a></li>
            <li><a href="formacioncontinua.html">FORMACION CONTINUA</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="oferta-academica.html">OFERTA ACADEMICA<i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="oferta-academica.html">PREGRADO</a></li>
            <li><a href="formacion-continua.html">FORMACION CONTINUA</a></li>
          </ul>
        </li>
        <!--<li class="dropdwon"><a href="formacionContinua.html">FORMACION CONTINUA</a>-->
        <a href="matriculate-Online.php">MATRICULATE ONLINE</a>
        <a href="metodologia-Estudio.html">METODOLOGIA DE ESTUDIO</a>
        <a href="https://bolivarianovirtual.com/login/index.php">BOLIVARIANO DIGITAL EDUCA</a>
      </nav>

    </div>

    <div class="menu-mobile">
      <label for="check" class="menu-icon">
        <i class="fa-solid fa-bars"></i>
      </label>
      <input type="checkbox" id="check" class="menu_checkbox">
      <ul class="menu-mobile-items">
        <!--<li><a href="index.html">Inicio</a></li>-->
        <li class="dropdown"><a href="admisiones-iub.html">ADMISIONES<i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="oferta-academica.html">PREGRADO</a></li>
            <li><a href="formacioncontinua.html">FORMACION CONTINUA</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="oferta-academica.html">OFERTA ACADEMICA<i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="oferta-academica.html">PREGRADO</a></li>
            <li><a href="formacioncontinua.html">FORMACION CONTINUA</a></li>
          </ul>
        </li>
        <!--<li class="dropdwon"><a href="formacionContinua.html">FORMACION CONTINUA</a>-->
        <a href="matriculate-Online.php">MATRICULATE ONLINE</a>
        <a href="metodologia-estudio.html">METODOLOGIA DE ESTUDIO</a>
        <a href="https://bolivarianovirtual.com/login/index.php">BOLIVARIANO DIGITAL EDUCA</a>
      </ul>
    </div>

  </header>


  <main class="ingreso">

    <div class="column">
      <div class="card">
        <div class="data-rowX">
          <div class="left-column">
            <h2> </h2>
          </div>
          <div class="right-column">
            <form class="form-ingreso" action="matriculate-online\php-bd\login.php" method="POST">
              <div class="imagen-form">
                <img src="assets/images/logos/BolOnline.png" alt="Descripción de la imagen">
              </div>

              <label for="usuario">USUARIO</label>
              <input type="text" id="usuario" name="usuario" required>

              <label for="contrasena">CONTRASEÑA</label>
              <input type="password" id="contrasena" name="contrasena" required>

              <button type="submit">INGRESAR</button>

              <p class="olvide-contrasena"><a href="#">Olvidé mi contraseña</a></p>
            </form>
          </div>
        </div>
      </div>

    </div>

  </main>

  <footer>

    <!--<img src="assets/images/logos/Bolivariano.png" alt="Bolivariano">-->
    <div class="direccion">

      <div class="direccion-contenido">
        <h6>Instituto Universitario Bolivariano</h6>
        <p><i class="fa-solid fa-location-dot"></i>José A. Eguiguren entre Bolivar y Sucre</p>
        <p><i class="fa-solid fa-phone-volume"></i>593-072575245</p>
        <p><i class="fa-solid fa-mobile"></i></p>
        <p><i class="fa-solid fa-envelope"></i>info@tbolivariano.edu.ec</p>
      </div>

      <div class="mapa">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d995.029451934456!2d-79.2037456!3d-3.9961929!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb48004b0462d3%3A0x39a0fac78bee059b!2sUniversitario%20Bolivariano%20Loja!5e0!3m2!1ses!2sec!4v1717618850928!5m2!1ses!2sec"
          width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

    </div>

    <div class="footer-fin">
      <div class="iconos">
        <a href="https://www.youtube.com/channel/UCL1pzhEf9Q5CT_Hp7cDvMiw" target="_blank" rel="noopener"><i
            class="bi bi-youtube"></i></a>
        <a href="https://www.facebook.com/Instituto-Tecnol%C3%B3gico-Bolivariano-Loja-800671470025862/" target="_blank"
          rel="noopener"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/universitariobolivarianoloja/?hl=es-la" target="_blank" rel="noopener"><i
            class="bi bi-instagram"></i></a>
        <a href="https://twitter.com/BolivarianoLoja" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
        <a href="https://www.linkedin.com/company/instituto-tecnol%C3%B3gico-bolivariano" target="_blank"
          rel="noopener"><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="text-center texto-footer">
        <p> <span>Diseñado por Instituto Superior Universitario Bolivariano </span> &#169 2024 </p>
        <p>Desarrollado por Corp. Simtelec</p>
      </div>
    </div>

    <!--<img src="assets/images/logos/BolOnline.png" alt="BolivarianoOnline">-->

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>


</body>

</html>