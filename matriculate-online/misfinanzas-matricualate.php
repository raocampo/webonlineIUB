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
      <div class="card" id="estado-cuenta">
        <h2>Estado de cuenta</h2>
        <div class="data-rowX">
          <span class="value-finanzas">
            Se muestra el valor a pagar, incluida la beca otorgada (si la ha solicitado). Una vez realizado el pago,
            deberá esperar aproximadamente 10 minutos para visualizar lo ya cancelado. Si el estudiante desea aplicar a
            un plan de pagos puede ir a la siguiente Opción
          </span>
        </div>
        <div class="button-container">
          <button class="detalle-periodo-btn">Detalle Período</button>
          <button class="plan-pagos-btn">Plan de Pagos</button>
        </div>
      </div>

      <div class="card" id="facturas">
        <h2>Facturas</h2>
        <div class="data-row">
          <span class="label">Programa:</span>
          <select class="value select-program">
            <option value="" disabled selected>Elija un programa</option>
            <option value="cca-tecnologia-computacion">CCA TECNOLOGIA COMPUTACION</option>
            <option value="otro-programa">Otro Programa</option>
            <!-- Agrega más opciones según sea necesario -->
          </select>
        </div>
        <div class="data-rowX">
          <span class="label">Período Académico:</span>
          <select class="value select-program">
            <option value="" disabled selected>Elija un período</option>
            <option value="periodo1">ABR 2024 - AGO 2024</option>
            <option value="periodo2">OCT 2023 - FEB 2024</option>
            <!-- Agrega más opciones según sea necesario -->
          </select>
        </div>
        <div class="button-container">
          <button class="continuar-fac">Continuar</button>
          <button class="cancelar-fac">Cancelar</button>
        </div>

      </div>

    </div>
    <div class="column">
      <div class="card" id="pagos-pendientes">
        <h2 class="section-title">Pagos Pendientes</h2>
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
              <td><?php echo $usuario_pgsp['colegiatura']; ?></td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td><?php echo $usuario_pgsp['intereses']; ?></td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td><?php echo $usuario_pgsp['otros']; ?></td>
              <td>USD $0</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card" id="pagos-aplicados">
        <h2 class="section-title">Pagos Aplicados</h2>
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
              <td><?php echo $usuario_pgsa['colegiatura']; ?></td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td><?php echo $usuario_pgsa['intereses']; ?></td>
              <td>USD $0</td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td><?php echo $usuario_pgsa['otros']; ?></td>
              <td>USD $0</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>

</html>