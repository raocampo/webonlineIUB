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
        <span class="user-welcome">Bienvenido <?php echo htmlspecialchars($usuario['usuario']); ?></span>
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
      <div class="card">
        <h2>Datos Personales</h2>
        <div class="image-containerH">
          <img src="../assets/images/matriculaOnline/avatarUser.png" alt="Foto de Perfil">
          <span class="label update-photo">Actualizar Foto</span>

        </div>
        <div class="data-row">
          <span class="label">Nombres:</span>
          <span class="value"><?php echo $usuario['nombres']; ?></span>
        </div>
        <div class="data-row">
          <span class="label">Número de matrícula:</span>
          <span class="value"><?php echo $usuario['nro_matricula']; ?></span>
        </div>
        <div class="data-row">
          <span class="label">Campus:</span>
          <span class="value">Bolivariano Loja</span>
        </div>
        <div class="data-row">
          <span class="label">Identificación:</span>
          <span class="value"><?php echo $usuario['identificacion']; ?></span>
        </div>
        <div class="data-row">
          <span class="label">Número de teléfono:</span>
          <span class="value"><?php echo $usuario['nmr_tel']; ?></span>
        </div>
      </div>
      <div class="card next-payment">
        <h2 class="section-title">Último pago</h2>
        <table class="payment-table">
          <thead>
            <tr>
              <th>Modalidad</th>
              <th>Monto</th>
              <th>Fecha Límite</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Presencial</td>
              <td>$5000</td>
              <td>30/03/2024</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card saldos">
        <h2 class="section-title">Saldos</h2>
        <table class="saldos-table">
          <thead>
            <tr>
              <th></th>
              <th>Saldos</th>
              <th>Saldo Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Colegiatura</td>
              <td>USD $0</td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td>USD $0</td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td>USD $0</td>
              <td>USD $0</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <h2>Programas Inscritos</h2>
        <div class="data-rowX">
          <span class="value">Tecnología en Ciencias de Datos</span>
        </div>
      </div>
    </div>
  </main>

</body>

</html>