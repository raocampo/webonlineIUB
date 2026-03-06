<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio - Matricúlate Online | Instituto Bolivariano</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<?php
require_once 'php-bd/security-helper.php';
require_once 'php-bd/obtener_datos.php';
?>

  <header class="header">
    <div class="logo-container">
      <a href="../">
        <img src="../assets/images/logos/BolOnline.png" alt="Logo Instituto Bolivariano" width="150">
      </a>
    </div>
    <div class="user-info">
      <div class="user-details">
        <span class="user-welcome"><i class="fas fa-user-circle"></i> <?php echo esc($usuario['nombres'] ?? $usuario['usuario']); ?></span>
        <form action="php-bd/logout.php" method="post" style="display:inline;">
          <?php echo SecurityHelper::csrfField(); ?>
          <button class="logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
        </form>
      </div>
    </div>
  </header>

  <?php include 'components/nav.php'; ?>

  <main class="content">
    <div class="column">
      <div class="card">
        <h2><i class="fas fa-user"></i> Datos Personales</h2>
        <div class="image-containerH">
          <?php
          $fotoUrl = !empty($usuario['foto_perfil']) ? '../' . $usuario['foto_perfil'] : '../assets/images/matriculaOnline/avatarUser.png';
          ?>
          <img src="<?php echo esc($fotoUrl); ?>" alt="Foto de Perfil" class="profile-photo-sm">
          <a href="perfil-matriculate.php" class="label update-photo"><i class="fas fa-camera"></i> Actualizar Foto</a>
        </div>
        <div class="data-row">
          <span class="label">Nombres:</span>
          <span class="value"><?php echo esc($usuario['nombres']); ?></span>
        </div>
        <div class="data-row">
          <span class="label">Número de matrícula:</span>
          <span class="value"><?php echo esc($usuario['nro_matricula']); ?></span>
        </div>
        <div class="data-row">
          <span class="label">Campus:</span>
          <span class="value">Bolivariano Loja</span>
        </div>
        <div class="data-row">
          <span class="label">Identificación:</span>
          <span class="value"><?php echo esc($usuario['identificacion']); ?></span>
        </div>
        <div class="data-row">
          <span class="label">Número de teléfono:</span>
          <span class="value"><?php echo esc($usuario['nmr_tel']); ?></span>
        </div>
      </div>

      <div class="card next-payment">
        <h2 class="section-title"><i class="fas fa-money-bill-wave"></i> Último Pago</h2>
        <?php
        try {
          $stmtPago = $pdo->prepare("SELECT * FROM pagos WHERE usuario_id = ? ORDER BY fecha_pago DESC LIMIT 1");
          $stmtPago->execute([$_SESSION['usuario_id']]);
          $ultimoPago = $stmtPago->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          $ultimoPago = null;
        }
        ?>
        <?php if ($ultimoPago): ?>
        <table class="payment-table">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Monto</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo esc($ultimoPago['concepto'] ?? 'Pago de Matrícula'); ?></td>
              <td>$<?php echo number_format($ultimoPago['monto'], 2); ?></td>
              <td><?php echo date('d/m/Y', strtotime($ultimoPago['fecha_pago'])); ?></td>
            </tr>
          </tbody>
        </table>
        <?php else: ?>
        <p class="empty-state"><i class="fas fa-info-circle"></i> No hay pagos registrados aún.</p>
        <?php endif; ?>
      </div>

      <div class="card saldos">
        <h2 class="section-title"><i class="fas fa-balance-scale"></i> Saldos</h2>
        <?php
        try {
          $stmtSaldo = $pdo->prepare("SELECT * FROM pagos_pendientes WHERE usuario_id = ? LIMIT 1");
          $stmtSaldo->execute([$_SESSION['usuario_id']]);
          $saldo = $stmtSaldo->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          $saldo = null;
        }
        ?>
        <table class="saldos-table">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Colegiatura</td>
              <td><?php echo $saldo ? 'USD $' . number_format($saldo['colegiatura'], 2) : 'USD $0.00'; ?></td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td><?php echo $saldo ? 'USD $' . number_format($saldo['intereses'], 2) : 'USD $0.00'; ?></td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td><?php echo $saldo ? 'USD $' . number_format($saldo['otros'], 2) : 'USD $0.00'; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="column">
      <div class="card">
        <?php
        $data = include 'php-bd/obtener-carrera.php';
        $nombreCarrera = $data['nombreCarrera'];
        $desCarrera = $data['desCarrera'];
        $semestre = $data['semestre'] ?? 'Actual';
        include 'php-bd/obtener-asignaturas.php';
        ?>

        <h2><i class="fas fa-graduation-cap"></i> Programas Inscritos</h2>
        <div class="data-rowX">
          <h3 class="value"><?php echo htmlspecialchars($nombreCarrera); ?></h3>
        </div>
        <div class="data-rowX">
          <span><?php echo htmlspecialchars($desCarrera); ?></span>
        </div>
        <div class="data-rowX">
          <table class="saldos-table">
            <thead>
              <tr>
                <th colspan="3">SEMESTRE <?php echo htmlspecialchars((string)$semestre); ?></th>
              </tr>
              <tr>
                <th>Asignatura</th>
                <th>Clave</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($asignaturas)) {
                foreach ($asignaturas as $asignatura) {
                  echo '<tr>
                    <td>' . htmlspecialchars($asignatura['nmb_mtr']) . '</td>
                    <td>' . htmlspecialchars($asignatura['clave']) . '</td>
                    <td><span class="badge-estado ec">En Curso</span></td>
                  </tr>';
                }
              } else {
                echo '<tr><td colspan="3" class="empty-state">No hay asignaturas registradas</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <h2><i class="fas fa-link"></i> Accesos Rápidos</h2>
        <div class="quick-links">
          <a href="https://bolivarianovirtual.com/login/index.php" target="_blank" rel="noopener" class="quick-link-btn">
            <i class="fas fa-chalkboard-teacher"></i> Aula Virtual
          </a>
          <a href="misfinanzas-matricualate.php" class="quick-link-btn">
            <i class="fas fa-file-invoice-dollar"></i> Mis Finanzas
          </a>
          <a href="documentos_matriculate.php" class="quick-link-btn">
            <i class="fas fa-folder-open"></i> Mis Documentos
          </a>
          <a href="tramites_matriculate.php" class="quick-link-btn">
            <i class="fas fa-clipboard-list"></i> Trámites
          </a>
        </div>
      </div>
    </div>
  </main>

</body>

</html>
