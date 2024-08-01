<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Robert Ocampo (R@0/CorpSimtelec)" />
  <meta name="description" content="Bolivariano Online" />
  <meta name="keywords" content="Bolivariano Online" />

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


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
        <a href="index.html"><img src="assets/images/home1.png" alt="iconoInicio"></a>
        <li class="dropdown1"><a href="admisiones-iub.html">ADMISIONES<i class="bi bi-chevron-down"></i></a>
          <ul> 
            <li><a href="oferta-academica.html">CARRERAS UNIVERSITARIAS</a></li> 
            <li><a href="formacion-continua.html">FORMACIÓN CONTINUA</a></li>
            <li><a href="formacion-continua.html">POSGRADOS</a></li>    
          </ul>
        </li>
        <li class="dropdown"><a href="oferta-academica.html">OFERTA ACADÉMICA<!--<i class="bi bi-chevron-down"></i>--></a>
          <!--<ul> 
            <li><a href="oferta-academica.html">PREGRADO</a></li>
            <li><a href="formacion-continua.html">FORMACION CONTINUA</a></li>   
          </ul>-->
        </li>
        <!--<li class="dropdwon"><a href="formacionContinua.html">FORMACION CONTINUA</a>-->
        <a href="http://bolivarianonline.atwebpages.com/matriculate-online.php" target="_blank">MATRICÚLATE ONLINE</a>
        <a href="metodologia-estudio.html">METODOLOGÍA DE ESTUDIO</a>
        <a href="https://bolivarianovirtual.com/login/index.php">EVA BOLIVARIANO ONLINE</a>
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
            <li><a href="oferta-academica.html">CARRERAS UNIVERSITARIAS</a></li> 
            <li><a href="formacion-continua.html">FORMACIÓN CONTINUA</a></li>
            <li><a href="formacion-continua.html">POSGRADOS</a></li>   
          </ul>
        </li>
        <li class="dropdown"><a href="oferta-academica.html">OFERTA ACADÉMICA<i class="bi bi-chevron-down"></i></a>
          <!--<ul> 
            <li><a href="oferta-academica.html">PREGRADO</a></li> 
            <li><a href="formacion-continua.html">FORMACION CONTINUA</a></li>   
          </ul>-->
        </li>
        <!--<li class="dropdwon"><a href="formacionContinua.html">FORMACION CONTINUA</a>-->
        <a href="matriculate-online.php">MATRICÚLATE ONLINE</a>
        <a href="metodologia-estudio.html">METODOLOGÍA DE ESTUDIO</a>
        <a href="https://bolivarianovirtual.com/login/index.php">EVA BOLIVARIANO ONLINE</a>
      </ul>  
    </div>

  </header>


  <main class="ingreso">

    <div class="column">
      <div class="card1">
        <div style="margin-top: 25rem;">
          <h2 style="color: rgb(255, 255, 255);">¿Ya eres estudiante?</h2>
          <span style="color: white;"> Ingresa aquí</span>
        <div class="button-container">
          <button type="button" class="guardar-btn" data-toggle="modal" data-target="#loginModal">Ingresar</button>
        </div>
        </div>
        
      </div>

      <!-- Modal -->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form id="loginForm" method="post" action="matriculate-online/php-bd/login.php">
                <div class="form-group">
                  <label for="usuario">Usuario:</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario"
                    required>
                </div>
                <div class="form-group">
                  <label for="contrasena">Contraseña:</label>
                  <input type="password" class="form-control" id="contrasena" name="contrasena"
                    placeholder="Ingrese su contraseña" required>
                </div>
                <div class="button-container">
                  <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <div class="cardS">
        <h2>Matriculate Online</h2>
        <form id="formulario" method="post" action="guardar.php" style="text-align: left;"
          enctype="multipart/form-data">
          <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" placeholder="Ingrese los nombres" required>
          </div>
          <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos" required>
          </div>
          <div class="form-group">
            <label for="identificacion">Identificación:</label>
            <input type="text" id="identificacion" name="identificacion" placeholder="Ingrese la identificación"
              required>
          </div>
          <div class="form-group">
            <label for="nmr_tel">Teléfono:</label>
            <input type="text" id="nmr_tel" name="nmr_tel" placeholder="Ingrese el teléfono" required>
          </div>
          <div class="form-group">
            <label for="fch_nac">Fecha de Nacimiento:</label>
            <input type="date" id="fch_nac" name="fch_nac" required>
          </div>
          <div class="form-group">
            <label for="est_cvl">Estado Civil:</label>
            <input type="text" id="est_cvl" name="est_cvl" placeholder="Ingrese el estado civil" required>
          </div>
          <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección" required>
          </div>
          <div class="form-group">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" placeholder="Ingrese el país" required>
          </div>
          <div class="form-group">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" placeholder="Ingrese la provincia" required>
          </div>
          <div class="form-group">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" placeholder="Ingrese la ciudad" required>
          </div>
          <div class="form-group">
            <label for="carrera">Carrera:</label>
            <select id="carrera" name="carrera" required>
              <option value="">Seleccione una carrera</option>
            </select>
          </div>
          <div class="form-group">
            <label>Método de Pago:</label>
            <div>
              <input type="radio" id="transferencia" name="metodo_pago" value="transferencia" required>
              <label for="transferencia">Transferencia</label>
              <input type="radio" id="tarjeta_credito" name="metodo_pago" value="tarjeta_credito" required>
              <label for="tarjeta_credito">Tjt. de Crédito</label>
            </div>
          </div>
          <div class="form-group hidden" id="comprobante-section">
            <label for="comprobante">Subir Comprobante:</label>
            <input type="file" id="comprobante" name="comprobante" accept="application/pdf">
          </div>
          <div class="form-group hidden" id="tarjeta-section">
            <label for="tarjeta_info">Tarjeta de crédito:</label>
            <button type="button" class="cargar-btn" data-toggle="modal" data-target="#creditCardModal">Ingresar
              información</button>
          </div>

          <!-- Modal para ingresar datos de la tarjeta de crédito -->
          <div class="modal fade" id="creditCardModal" tabindex="-1" role="dialog"
            aria-labelledby="creditCardModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="creditCardModalLabel">Información de la Tarjeta de Crédito</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="creditCardForm">
                    <div class="form-group">
                      <label for="cardName">Nombres y apellidos:</label>
                      <input type="text" class="form-control" id="cardName" name="cardName"
                        placeholder="Ingrese el nombre en la tarjeta" required>
                    </div>
                    <div class="form-group">
                      <label for="cardNumber">Número de la tarjeta:</label>
                      <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                        placeholder="Ingrese el número de tarjeta" required>
                    </div>
                    <div class="form-group">
                      <label for="expirationDate">Fecha de Expiración:</label>
                      <input type="date" class="form-control" id="expirationDate" name="expirationDate"
                        placeholder="MM/AA" required>
                    </div>
                    <div class="form-group">
                      <label for="cvv">CVV:</label>
                      <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Ingrese el CVV" required>
                    </div>
                    <div class="button-container">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="guardar-btn">Guardar</button>
        </form>
      </div>



    </div>


    <script>

      $(document).ready(function () {
        // Ocultar ambas secciones al cargar la página
        $.ajax({
          url: 'matriculate-online/php-bd/cargar-carreras.php',
          method: 'GET',
          success: function (response) {
            try {
              var carreras = JSON.parse(response);
              var carreraSelect = $('#carrera');
              carreraSelect.empty(); // Limpiar el select antes de agregar opciones
              carreraSelect.append('<option value="">Seleccione una carrera</option>'); // Añadir opción por defecto

              carreras.forEach(function (carrera) {
                carreraSelect.append('<option value="' + carrera.nombre + '">' + carrera.nombre + '</option>');
              });
            } catch (e) {
              console.error('Error al procesar la respuesta:', e);
            }
          },
          error: function (xhr, status, error) {
            console.error('Error al cargar carreras:', error);
          }
        });

        // Ocultar ambas secciones al cargar la página
        $('#comprobante-section').addClass('hidden');
        $('#tarjeta-section').addClass('hidden');

        // Manejar el cambio de los botones de radio
        $('input[name="metodo_pago"]').on('change', function () {
          if ($(this).val() === 'transferencia') {
            $('#comprobante-section').removeClass('hidden');
            $('#tarjeta-section').addClass('hidden');
          } else if ($(this).val() === 'tarjeta_credito') {
            $('#comprobante-section').addClass('hidden');
            $('#tarjeta-section').removeClass('hidden');
          }
        });
      });

    </script>



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