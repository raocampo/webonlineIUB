<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Finanzas - Matricúlate Online | Instituto Bolivariano</title>
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
      <div class="card" id="estado-cuenta">
        <h2><i class="fas fa-file-alt"></i> Estado de Cuenta</h2>
        <div class="data-rowX">
          <p class="value-finanzas">
            Se muestra el valor a pagar, incluida la beca otorgada (si la ha solicitado). Una vez realizado el pago,
            deberá esperar aproximadamente 10 minutos para visualizar lo ya cancelado. Si el estudiante desea aplicar a
            un plan de pagos puede ir a la siguiente opción.
          </p>
        </div>
        <div class="button-container">
          <button class="detalle-periodo-btn"><i class="fas fa-calendar-alt"></i> Detalle Período</button>
          <button class="plan-pagos-btn"><i class="fas fa-list-ol"></i> Plan de Pagos</button>
        </div>
      </div>

      <div class="card" id="facturas">
        <h2><i class="fas fa-receipt"></i> Facturas</h2>
        <div class="data-row">
          <span class="label">Programa:</span>
          <select class="value select-program" id="selectPrograma">
            <option value="" disabled selected>Elija un programa</option>
            <option value="cca-tecnologia-computacion">CCA TECNOLOGÍA COMPUTACIÓN</option>
            <option value="adm-empresas">ADMINISTRACIÓN DE EMPRESAS</option>
            <option value="contabilidad">CONTABILIDAD Y AUDITORÍA</option>
          </select>
        </div>
        <div class="data-rowX">
          <span class="label">Período Académico:</span>
          <select class="value select-program" id="selectPeriodo">
            <option value="" disabled selected>Elija un período</option>
            <option value="periodo1">ABR 2025 - AGO 2025</option>
            <option value="periodo2">OCT 2024 - FEB 2025</option>
            <option value="periodo3">ABR 2024 - AGO 2024</option>
          </select>
        </div>
        <div class="button-container">
          <button class="continuar-fac"><i class="fas fa-search"></i> Buscar</button>
          <button class="cancelar-fac"><i class="fas fa-times"></i> Cancelar</button>
        </div>
      </div>

    </div>
    <div class="column">
      <div class="card" id="pagos-pendientes">
        <h2 class="section-title"><i class="fas fa-exclamation-circle"></i> Pagos Pendientes</h2>
        <table class="saldos-table">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Saldo</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Colegiatura</td>
              <td><?php echo esc((string)($usuario_pgsp['colegiatura'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td><?php echo esc((string)($usuario_pgsp['intereses'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td><?php echo esc((string)($usuario_pgsp['otros'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card" id="pagos-aplicados">
        <h2 class="section-title"><i class="fas fa-check-circle"></i> Pagos Aplicados</h2>
        <table class="saldos-table">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Saldo</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Colegiatura</td>
              <td><?php echo esc((string)($usuario_pgsa['colegiatura'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
            <tr>
              <td>Intereses</td>
              <td><?php echo esc((string)($usuario_pgsa['intereses'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
            <tr>
              <td>Accesorios</td>
              <td><?php echo esc((string)($usuario_pgsa['otros'] ?? 'USD $0.00')); ?></td>
              <td>USD $0.00</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Historial de Pagos con Descargas -->
      <div class="card" id="historial-pagos">
        <h2 class="section-title">
          <i class="fas fa-history"></i> Historial de Pagos
        </h2>
        <?php
        // Obtener historial de pagos del usuario
        try {
            $stmt = $pdo->prepare("
                SELECT * FROM pagos 
                WHERE usuario_id = ? 
                ORDER BY fecha_pago DESC 
                LIMIT 10
            ");
            $stmt->execute([$_SESSION['usuario_id']]);
            $pagos = $stmt->fetchAll();
        } catch (PDOException $e) {
            $pagos = [];
        }
        ?>
        
        <?php if (empty($pagos)): ?>
          <p class="empty-state"><i class="fas fa-info-circle"></i> No hay pagos registrados aún.</p>
        <?php else: ?>
          <table class="saldos-table">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pagos as $pago): ?>
                <tr>
                  <td><?php echo date('d/m/Y', strtotime($pago['fecha_pago'])); ?></td>
                  <td><?php echo esc($pago['concepto'] ?? 'Pago de Matrícula'); ?></td>
                  <td>$<?php echo number_format($pago['monto'], 2); ?></td>
                  <td>
                    <span class="badge-status <?php echo esc($pago['estado']); ?>">
                      <?php echo ucfirst(esc($pago['estado'])); ?>
                    </span>
                  </td>
                  <td>
                    <a href="php-bd/generar-comprobante.php?id=<?php echo (int)$pago['id']; ?>"
                       target="_blank"
                       class="btn-download"
                       title="Descargar comprobante">
                      <i class="fas fa-file-pdf"></i> Comprobante
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
        
        <div class="certificate-section">
          <a href="php-bd/generar-certificado.php" target="_blank" class="btn-certificate">
            <i class="fas fa-certificate"></i> Descargar Certificado de Matrícula
          </a>
        </div>
      </div>
    </div>
  </main>

</body>

</html>