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
    <div class="column" id="materias">
      <div class="card datos-personales">
        <h2>Conoce nuestras carreras que cuentan con aulta virtual</h2>
        <div class="data-rowX">
          <div class="left-column">
            <h3>Tecnología Computacional</h3>
            <div class="image-container">
              <img src="../assets/images/matriculaOnline/computacional.jpg" alt="Tecnología Computacional">
            </div>
            <p>Accede a nuestro entorno virtual.</p>
            <button class="btn-acceder">Acceder</button>
          </div>
          <div class="center-column">
            <h3>Ciencias en Redes</h3>
            <div class="image-container">
              <img src="../assets/images/matriculaOnline/redes.jpg" alt="Ciencias en Redes">
            </div>
            <p>Accede a nuestro entorno virtual</p>
            <button class="btn-acceder">Acceder</button>
          </div>
          <div class="right-column">
            <h3>Tecnología en Redes</h3>
            <div class="image-container">
              <img src="../assets/images/matriculaOnline/redes2.jpg" alt="Tecnología en Redes Distribuidas">
            </div>
            <p>Accede a nuestro entorno virtual</p>
            <button class="btn-acceder">Acceder</button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>



</body>

</html>