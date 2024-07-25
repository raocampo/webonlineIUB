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
    <?php include 'php-bd/obtener_datos.php'; ?>
    <div class="logo-container">
      <img src="../assets/images/logos/BolOnline.png" alt="Logo Instituto Bolivariano">
    </div>
    <div class="user-info">
      <div class="user-details">
        <span class="user-welcome">Bienvenido <?php echo $usuario['usuario']; ?></span>
        <form action="php-bd/logout.php" method="post" style="display:inline;">
          <button class="logout-btn" type="submit">Cerrar Sesión</button>
        </form>
      </div>
    </div>
  </header>

  <nav class="navigation">
    <ul class="menu">
      <li><a href="inicio_matriculate.php" class="nav-btn">Inicio</a></li>
      <li><a href="perfil-matriculate.php" class="nav-btn">Perfil</a></li>
      <li class=><a href="misfinanzas-matricualate.php" class="nav-btn">Mis Finanzas</a></li>
      <li class="nav-dropdown">
        <a href="aula-virtual_matriculate.php" class="nav-btn">Aula Virtual <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="https://bolivarianovirtual.com/login/index.php">Acceder</a></li>
        </ul>
      </li>
      <li><a href="tramites_matriculate.php" class="nav-btn">Trámites en Línea IUBS</a></li>
      <li><a href="institucionales.php" class="nav-btn">Reglamentos/Misión/Visión</a></li>
    </ul>
  </nav>

  <main class="content">
    <?php include 'php-bd/obtener_datos.php'; ?>
    <div class="column">
      <div class="card datos-personales" id="datos-personales">
        <h2>Datos Personales</h2>
        <form action="php-bd/actualizar_datosP.php" method="POST">
          <div class="data-rowX">
            <div class="left-column">
              <div class="image-containerH">
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
                <span class="label">Nro. de teléfono:</span>
                <input type="text" class="value" name="nmr_tel" value="<?php echo $usuario['nmr_tel']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Fecha nacimiento:</span>
                <input type="text" class="value" name="fch_nac" value="<?php echo $usuario['fch_nac']; ?>">
              </div>
            </div>
            <div class="right-column">
              <div class="data-row">
                <span class="label">Dirección:</span>
                <input type="text" class="value" name="direccion" value="<?php echo $usuario['direccion']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Estado Civil:</span>
                <input type="text" class="value" name="est_cvl" value="<?php echo $usuario['est_cvl']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Ciudad:</span>
                <input type="text" class="value" name="ciudad" value="<?php echo $usuario['ciudad']; ?>">
              </div>
              <div class="data-row">
                <span class="label">País:</span>
                <input type="text" class="value" name="pais" value="<?php echo $usuario['pais']; ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn-guardar">Guardar</button>
        </form>
      </div>

      <div class="card domicilios" id="domicilios">
        <h2>Domicilios</h2>
        <form action="php-bd/actualizar_domicilios.php" method="POST">
          <div class="data-rowX">
            <div class="left-column">
              <!-- Datos de domicilio izquierda -->
              <div class="data-row">
                <span class="label">Calle Princial:</span>
                <input type="text" class="value" name="cll_prn" value="<?php echo $usuario_dmc['cll_prn']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Calle Secundaria:</span>
                <input type="text" class="value" name="cll_scn" value="<?php echo $usuario_dmc['cll_scn']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Ciudad:</span>
                <input type="text" class="value" name="ciudad" value="<?php echo $usuario['ciudad']; ?>">
              </div>
              <div class="data-row">
                <span class="label">País:</span>
                <input type="text" class="value" name="pais" value="<?php echo $usuario['pais']; ?>">
              </div>
            </div>
            <div class="right-column">
              <!-- Datos de domicilio derecha -->
              <div class="data-row">
                <span class="label">Provincia:</span>
                <input type="text" class="value" name="provincia" value="<?php echo $usuario['provincia']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Código Postal:</span>
                <input type="text" class="value" name="cdg_pst" value="<?php echo $usuario_dmc['cdg_pst']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Teléfono de contacto:</span>
                <input type="text" class="value" name="tlf_cnt" value="<?php echo $usuario_dmc['tlf_cnt']; ?>">
              </div>
              <div class="data-row">
                <span class="label">Referencia de domicilio:</span>
                <input type="text" class="value" name="referencia" value="<?php echo $usuario_dmc['referencia']; ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn-guardar">Guardar</button>
        </form>
      </div>


      <div class="card ref-personal" id="referencia-personal">
        <h2>Referencia Personal</h2>
        <div class="image-upload-button">
          <button>Subir Imagen</button>
        </div>
      </div>

    </div>
  </main>

</body>

</html>