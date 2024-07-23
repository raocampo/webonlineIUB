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
    <div class="column">
      <div class="card" id="tramites">
        <h2>Trámites IUBS</h2>
        <div class="data-row">
          <span class="label">Tipo de trámite:</span>
          <select class="value select-program">
            <option value="" disabled selected>Elija un trámite</option>
            <option value="cca-tecnologia-computacion">Certificados</option>
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
        <h2>Documetos</h2>
        <div class="data-row">
          <span class="label">Titulo Bachiller</span>
          <button class="continuar-fac">Subir PDF</button>
        </div>
        <div class="data-rowX">
          <span class="label">Cédula</span>
          <button class="continuar-fac">Subir PDF</button>
        </div>

      </div>
    </div>

    <div class="column">
      <div class="card" id="record-academico">
        <h2 class="section-title">Récord Académico</h2>
        <?php
        // Incluir y obtener el array de materias del semestre 1 desde obtener-carrera.php
        $data = include 'php-bd/obtener-carrera.php';
        $nombreCarrera = $data['nombreCarrera'];
        ?>
        <h3 class="section">Carrera: <?php echo htmlspecialchars($nombreCarrera); ?></h3>
        <!-- Lista de materias del semestre 1 -->
        <button id="toggleSubjects1">Ver Semestre 1</button>
        <ul id="subjectList1" style="display: none;">
          <?php foreach ($materiasSemestre1 as $materia): ?>
            <li><?php echo $materia; ?></li>
          <?php endforeach; ?>
        </ul>
        <!-- Lista de materias del semestre 2 -->
        <button id="toggleSubjects2">Ver Semestre 2</button>
        <ul id="subjectList2" style="display: none;">
          <?php foreach ($materiasSemestre2 as $materia): ?>
            <li><?php echo $materia; ?></li>
          <?php endforeach; ?>
        </ul>
        <!-- Lista de materias del semestre 3 -->
        <button id="toggleSubjects3">Ver Semestre 3</button>
        <ul id="subjectList3" style="display: none;">
          <?php foreach ($materiasSemestre3 as $materia): ?>
            <li><?php echo $materia; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <script>
        // Agregar funcionalidad JavaScript para mostrar/ocultar listas de materias por semestre
        document.getElementById('toggleSubjects1').addEventListener('click', function () {
          toggleVisibility('subjectList1');
        });
        document.getElementById('toggleSubjects2').addEventListener('click', function () {
          toggleVisibility('subjectList2');
        });
        document.getElementById('toggleSubjects3').addEventListener('click', function () {
          toggleVisibility('subjectList3');
        });

        function toggleVisibility(elementId) {
          var element = document.getElementById(elementId);
          if (element.style.display === 'none') {
            element.style.display = 'block';
          } else {
            element.style.display = 'none';
          }
        }
      </script>



    </div>
  </main>

</body>

</html>