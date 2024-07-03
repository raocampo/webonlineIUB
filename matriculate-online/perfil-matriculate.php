<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Eric Alvarado">
  <title>Matriculate Online - Instituto Bolivariano</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Asegúrate de incluir Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <header class="header">
    <?php include 'obtener_datos.php'; ?>
    <div class="logo-container">
      <img src="../assets/images/logos/BolOnline.png" alt="Logo Instituto Bolivariano">
    </div>
    <div class="user-info">
      <div class="user-details">
        <span class="user-welcome">Bienvenido <?php echo $usuario['usuario']; ?></span>
        <form action="logout.php" method="post" style="display:inline;">
          <button class="logout-btn" type="submit">Cerrar Sesión</button>
        </form>
      </div>
    </div>
  </header>

  <nav class="navigation">
    <ul class="menu">
      <li><a href="inicio_matriculate.php" class="nav-btn">Inicio</a></li>
      <li class="nav-dropdown">
        <a href="#" class="nav-btn">Perfil <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="perfil-matriculate.html#datos-personales">Datos personales</a></li>
          <li><a href="perfil-matriculate.html#domicilios">Domicilios</a></li>
          <li><a href="perfil-matriculate.html#info-laboral">Información laboral</a></li>
          <li><a href="#">Referencia personal</a></li>
          <li><a href="#">Información académica</a></li>
        </ul>
      </li>
      <li class="nav-dropdown">
        <a href="misfinanzas-matricualate.php" class="nav-btn">Mis Finanzas <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="misfinanzas-matricualate.php#estado-cuenta">Estado de cuenta</a></li>
          <li><a href="misfinanzas-matricualate.php#pagos-pendientes">Pagos Pendientes</a></li>
          <li><a href="misfinanzas-matricualate.php#pagos-aplicados">Pagos Aplicados</a></li>
          <li><a href="misfinanzas-matricualate.php#facturas">Facturas</a></li>
        </ul>
      </li>
      <li class="nav-dropdown">
        <a href="aula-virtual_matriculate.php" class="nav-btn">Aula Virtual <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="#">Acceder</a></li>
          <li><a href="#">Materias Enroladas</a></li>
        </ul>
      </li>

      <li class="nav-dropdown">
        <a href="tramites_matriculate.php" class="nav-btn">Trámites en Línea <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="#">Trámites en Línea SIU</a></li>
          <li><a href="#">Personalizar Aprendizaje</a></li>
          <li><a href="#">Historial</a></li>
          <li><a href="#">Documentos</a></li>
        </ul>
      </li>
      <li class="nav-dropdown">
        <a href="institucionales.php" class="nav-btn">Reglamentos/Misión/Visión <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="#">Misión institucional</a></li>
          <li><a href="#">Política de privacidad</a></li>
          <li><a href="#">Lista de precios</a></li>
          <li><a href="#">Termios y condiciones</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <main class="content">
    <?php include 'obtener_datos.php'; ?>
    <div class="column">
      <div class="card datos-personales" id="datos-personales">
        <h2>Datos Personales</h2>
        <form action="actualizar_datos.php" method="POST">
          <div class="data-row">
            <div class="left-column">
              <div class="image-container">
                <img src="../assets/images/matriculaOnline/avatarUser.png" alt="Foto de Perfil">
                <span class="label update-photo">Subir Foto</span>
              </div>
            </div>
            <div class="center-column">
              <div class="data-row">
                <span class="label">Nombres:</span>
                <input type="text" class="value" name="nombres" value="<?php echo $usuario['nombres']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Identificación:</span>
                <input type="text" class="value" name="identificacion"
                  value="<?php echo $usuario['identificacion']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Número de teléfono:</span>
                <input type="text" class="value" name="nmr_tel" value="<?php echo $usuario['nmr_tel']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Correo electrónico:</span>
                <input type="email" class="value" name="correo" value="<?php echo $usuario['correo']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Fecha de nacimiento:</span>
                <input type="text" class="value" name="fch_nac" value="<?php echo $usuario['fch_nac']; ?>">
              </div>
            </div>
            <div class="right-column">
              <div class="data-row">
                <span class="label">Dirección:</span>
                <input type="text" class="value" name="direccion" value="Calle Principal #123">
              </div>
              <div class="data-row">
                <span class="label">Estado Civil:</span>
                <input type="text" class="value" name="estado_civil" value="Casado/a">
              </div>
              <div class="data-row">
                <span class="label">Ciudad:</span>
                <input type="text" class="value" name="ciudad" value="Loja">
              </div>
              <div class="data-row">
                <span class="label">País:</span>
                <input type="text" class="value" name="pais" value="Ecuador">
              </div>
            </div>
          </div>
          <button type="submit" class="btn-guardar">Guardar</button>
        </form>
      </div>

      <div class="card domicilios" id="domicilios">
        <h2>Domicilios</h2>
        <div class="data-row">
          <div class="left-column">
            <!-- Datos de domicilio izquierda -->
            <div class="data-row">
              <span class="label">Dirección 1:</span>
              <input type="text" class="value" value="Av. Principal #456">
            </div>
            <div class="data-row">
              <span class="label">Dirección 2:</span>
              <input type="text" class="value" value="Calle Secundaria #789">
            </div>
            <div class="data-row">
              <span class="label">Ciudad:</span>
              <input type="text" class="value" value="Quito">
            </div>
            <div class="data-row">
              <span class="label">País:</span>
              <input type="text" class="value" value="Ecuador">
            </div>
          </div>
          <div class="right-column">
            <!-- Datos de domicilio derecha -->
            <div class="data-row">
              <span class="label">Estado:</span>
              <input type="text" class="value" value="Pichincha">
            </div>
            <div class="data-row">
              <span class="label">Código Postal:</span>
              <input type="text" class="value" value="170523">
            </div>
            <div class="data-row">
              <span class="label">Teléfono de contacto:</span>
              <input type="text" class="value" value="0998765432">
            </div>
            <div class="data-row">
              <span class="label">Referencia de domicilio:</span>
              <input type="text" class="value" value="Cerca del parque central">
            </div>
          </div>
        </div>
      </div>


      <div class="card info-laboral">
        <h2>Información Laboral</h2>
        <div class="data-row">
          <div class="left-column">
            <!-- Datos de domicilio izquierda -->
            <div class="data-row">
              <span class="label">Dirección 1:</span>
              <input type="text" class="value" value="Av. Principal #456">
            </div>
            <div class="data-row">
              <span class="label">Dirección 2:</span>
              <input type="text" class="value" value="Calle Secundaria #789">
            </div>
            <div class="data-row">
              <span class="label">Ciudad:</span>
              <input type="text" class="value" value="Quito">
            </div>
            <div class="data-row">
              <span class="label">País:</span>
              <input type="text" class="value" value="Ecuador">
            </div>
          </div>
          <div class="right-column">
            <!-- Datos de domicilio derecha -->
            <div class="data-row">
              <span class="label">Estado:</span>
              <input type="text" class="value" value="Pichincha">
            </div>
            <div class="data-row">
              <span class="label">Código Postal:</span>
              <input type="text" class="value" value="170523">
            </div>
            <div class="data-row">
              <span class="label">Teléfono de contacto:</span>
              <input type="text" class="value" value="0998765432">
            </div>
            <div class="data-row">
              <span class="label">Referencia de domicilio:</span>
              <input type="text" class="value" value="Cerca del parque central">
            </div>
          </div>
        </div>
      </div>

      <div class="card ref-personal">
        <h2>Referencia Personal</h2>
        <div class="image-upload-button">
          <button>Subir Imagen</button>
        </div>
      </div>

    </div>
  </main>

</body>

</html>