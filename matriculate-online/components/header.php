<?php
/**
 * Componente de header reutilizable
 * Uso: include 'components/header.php';
 */
require_once __DIR__ . '/../php-bd/security-helper.php';
require_once __DIR__ . '/../php-bd/obtener_datos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Eric Alvarado">
  <title><?php echo isset($pageTitle) ? esc($pageTitle) . ' - ' : ''; ?>Matricúlate Online - Instituto Bolivariano</title>
  
  <!-- Estilos -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../css/toast.css">
  <link rel="stylesheet" href="../css/dark-mode.css">
  <link rel="stylesheet" href="../css/file-upload.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <header class="header">
    <div class="logo-container">
      <img src="../assets/images/logos/BolOnline.png" alt="Logo Instituto Bolivariano">
    </div>
    <div class="user-info">
      <div class="user-details">
        <span class="user-welcome">Bienvenido <?php echo esc($usuario['usuario']); ?></span>
        <form action="php-bd/logout.php" method="post" style="display:inline;">
          <?php echo SecurityHelper::csrfField(); ?>
          <button class="logout-btn" type="submit">Cerrar Sesión</button>
        </form>
      </div>
    </div>
  </header>
<?php
// El contenido de la página irá después de incluir este header
?>