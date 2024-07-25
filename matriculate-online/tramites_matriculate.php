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
    <ul class="menu" style="margin-top: 1rem;">
      <li><a href="inicio_matriculate.php" class="nav-btn">Inicio</a></li>
      <li><a href="perfil-matriculate.php" class="nav-btn">Perfil</a></li>
      <li class=><a href="misfinanzas-matricualate.php" class="nav-btn">Mis Finanzas</a></li>
      <li class="nav-dropdown">
        <a href="aula-virtual_matriculate.php" class="nav-btn">Aula Virtual <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-content">
          <li><a href="https://bolivarianovirtual.com/login/index.php">Acceder</a></li>
        </ul>
      </li>
      <li><a href="tramites_matriculate.php" class="nav-btn">Trámites en Línea ISUB</a></li>
      <li><a href="institucionales.php" class="nav-btn">Reglamentos/Misión/Visión</a></li>
    </ul>
  </nav>
  <main class="content">
    <div class="column">
      <div class="card" id="tramites">
        <h2>Trámites ISUB</h2>
        <div class="data-row">
          <span class="label">Tipo de trámite:</span>
          <select class="value select-program">
            <option value="" disabled selected>Elija un trámite</option>
            <option value="otro-programa">Reporte estudiantil</option>
            <option value="otro-programa">Resolución conflictos</option>
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

      <div class="card" id="documentos">
        <h2>Documentos ISUB</h2>
        <form id="documentosForm">
          <div class="data-row">
            <label for="documentos">Documento:</label>
            <select id="documento" name="documento" required>
              <option value="">Seleccione el documento</option>
            </select>
          </div>
          <div class="data-row">
            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" readonly>
          </div>
          <div class="data-row">
            <label>Método de Pago:</label>
            <div>
              <input type="radio" id="transferencia" name="metodo_pago" value="transferencia" required>
              <label for="transferencia">Transferencia</label>
              <input type="radio" id="tarjeta_credito" name="metodo_pago" value="tarjeta_credito" required>
              <label for="tarjeta_credito">Tjt. de Crédito</label>
            </div>
          </div>
          <div class="data-row hidden" id="tarjeta-section">
            <label for="tarjeta_info">Tarjeta de crédito:</label>
            <button type="button" class="cargar-btn" data-toggle="modal" data-target="#creditCardModal">Ingresar
              información</button>
          </div>

          <!-- Modal para ingresar datos de la tarjeta de crédito -->
          <div id="creditCardModal" class="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Información de la Tarjeta de Crédito</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="button-container">
            <button type="submit" class="guardar-btn" id="solicitarBtn">Solicitar</button>
          </div>

        </form>
      </div>


    </div>

    <div class="column">
      <div class="card" id="record-academico">
        <h2 class="section-title">Récord Académico</h2>
        <?php
        // Incluir y obtener el array de materias del semestre 1 desde obtener-carrera.php
        $data = include 'php-bd/obtener-carrera.php';
        $nombreCarrera = $data['nombreCarrera'];
        include 'php-bd/obtener-asignaturas.php';
        ?>
        <h3 class="section">Carrera: <?php echo htmlspecialchars($nombreCarrera); ?></h3>
        <!-- Lista de materias del semestre 1 -->
        <div>
          <button class="button-X" style="background: #ade8f4" id="toggleSubjects1">Ver Semestre 1</button>
          <ul id="subjectList1" style="display: none;">
            <table class="saldos-table">
              <thead>
                <tr>
                  <th colspan="3">SEMESTRE 2</th>
                </tr>
                <tr>
                  <th>Asignatura</th>
                  <th>Clave</th>
                  <th>Progreso</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($asignaturas)) {
                  foreach ($asignaturas as $asignatura) {
                    echo "<tr>
                            <td>{$asignatura['nmb_mtr']}</td>
                            <td>{$asignatura['clave']}</td>
                            <td style='background:#ade8f4'>9 . 0</td>
                          </tr>";
                  }
                } else {
                  echo "<tr>
                        <td colspan='3'>No hay asignaturas registradas</td>
                      </tr>";
                }
                ?>
              </tbody>
            </table>
          </ul>
          <!-- Lista de materias del semestre 2 -->
          <button class="button-X"  id="toggleSubjects2">Ver Semestre 2</button>
          <ul id="subjectList2" style="display: none;">
            <table class="saldos-table">
              <thead>
                <tr>
                  <th colspan="3">SEMESTRE 2</th>
                </tr>
                <tr>
                  <th>Asignatura</th>
                  <th>Clave</th>
                  <th>Progreso</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($asignaturas)) {
                  foreach ($asignaturas as $asignatura) {
                    echo "<tr>
                            <td>{$asignatura['nmb_mtr']}</td>
                            <td>{$asignatura['clave']}</td>
                            <td style='background:green'>E C</td>
                          </tr>";
                  }
                } else {
                  echo "<tr>
                        <td colspan='3'>No hay asignaturas registradas</td>
                      </tr>";
                }
                ?>
              </tbody>
            </table>
          </ul>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tarjetaCreditoRadio = document.getElementById("tarjeta_credito");
      const tarjetaSection = document.getElementById("tarjeta-section");
      tarjetaCreditoRadio.addEventListener("change", function () {
        if (tarjetaCreditoRadio.checked) {
          tarjetaSection.classList.remove("hidden");
        } else {
          tarjetaSection.classList.add("hidden");
        }
      });

      const transferenciaRadio = document.getElementById("transferencia");
      transferenciaRadio.addEventListener("change", function () {
        if (transferenciaRadio.checked) {
          tarjetaSection.classList.add("hidden");
        }
      });
    });

    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('toggleSubjects1').addEventListener('click', function () {
        var subjectList1 = document.getElementById('subjectList1');
        if (subjectList1.style.display === 'none') {
          subjectList1.style.display = 'block';
        } else {
          subjectList1.style.display = 'none';
        }
      });
      document.getElementById('toggleSubjects2').addEventListener('click', function () {
        var subjectList2 = document.getElementById('subjectList2');
        if (subjectList2.style.display === 'none') {
          subjectList2.style.display = 'block';
        } else {
          subjectList2.style.display = 'none';
        }
      });
      $.ajax({
        url: 'php-bd/cargar-documentos.php',
        method: 'GET',
        success: function (response) {
          try {
            var documentos = JSON.parse(response);
            var documentoSelect = $('#documento');
            documentoSelect.empty();
            documentoSelect.append('<option value="">Seleccione el documento</option>');

            documentos.forEach(function (documento) {
              documentoSelect.append('<option value="' + documento.precio + '">' + documento.doc_nmb + '</option>');
            });

            documentoSelect.on('change', function () {
              var selectedPrice = $(this).val();
              $('#valor').val(selectedPrice);
            });
          } catch (e) {
            console.error('Error al procesar la respuesta:', e);
          }
        },
        error: function (xhr, status, error) {
          console.error('Error al cargar documentos:', error);
        }
      });
      document.getElementById('solicitarBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe
        alert('El documento será enviado a su correo luego de verificar el pago.');
      });

      $('#creditCardModal').modal('show');

      // Ocultar el modal
      $('#creditCardModal').modal('hide');
    });
  </script>

</body>

</html>