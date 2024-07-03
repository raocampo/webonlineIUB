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
                <a href="misfinanzas-matricualate.php" class="nav-btn">Mis Finanzas <i
                        class="fas fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="misfinanzas-matricualate.php#estado-cuenta">Estado de cuenta</a></li>
                    <li><a href="misfinanzas-matricualate.php#pagos-pendientes">Pagos Pendientes</a></li>
                    <li><a href="misfinanzas-matricualate.php#pagos-aplicados">Pagos Aplicados</a></li>
                    <li><a href="misfinanzas-matricualate.php#facturas">Facturas</a></li>
                </ul>
            </li>
            <li class="nav-dropdown">
                <a href="aula-virtual_matriculate.php" class="nav-btn">Aula Virtual <i
                        class="fas fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="#">Acceder</a></li>
                    <li><a href="#">Materias Enroladas</a></li>
                </ul>
            </li>

            <li class="nav-dropdown">
                <a href="tramites_matriculate.php" class="nav-btn">Trámites en Línea <i
                        class="fas fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="#">Trámites en Línea SIU</a></li>
                    <li><a href="#">Personalizar Aprendizaje</a></li>
                    <li><a href="#">Historial</a></li>
                    <li><a href="#">Documentos</a></li>
                </ul>
            </li>
            <li class="nav-dropdown">
                <a href="institucionales.php" class="nav-btn">Reglamentos/Misión/Visión <i
                        class="fas fa-caret-down"></i></a>
                <ul class="dropdown-content">
                    <li><a href="#">Misión institucional</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                    <li><a href="#">Lista de precios</a></li>
                    <li><a href="#">Termios y condiciones</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="content-institucional">
        <div class="card institucional-card">
            <div class="image-overlay">
                <img src="../assets/images/matriculaOnline/vision.jpg" alt="Imagen Institucional"
                    class="img-institucional">
                <div class="overlay-content">
                    <h2>CONOCE MÁS SOBRE NUESTROS REGLAMENTOS INSTITUCIONALES</h2>
                    <button class="btn-ver-mas">Ver más</button>
                </div>
            </div>
        </div>
    </main>





</body>

</html>