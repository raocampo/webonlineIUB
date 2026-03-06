<?php
/**
 * Componente de navegación reutilizable
 * Uso: include 'components/nav.php';
 */
$currentPage = basename($_SERVER['PHP_SELF']);
?>

  <nav class="navigation">
    <ul class="menu">
      <li>
        <a href="inicio_matriculate.php" class="nav-btn <?php echo $currentPage == 'inicio_matriculate.php' ? 'active' : ''; ?>">
          Inicio
        </a>
      </li>
      <li>
        <a href="perfil-matriculate.php" class="nav-btn <?php echo $currentPage == 'perfil-matriculate.php' ? 'active' : ''; ?>">
          Perfil
        </a>
      </li>
      <li>
        <a href="misfinanzas-matricualate.php" class="nav-btn <?php echo $currentPage == 'misfinanzas-matricualate.php' ? 'active' : ''; ?>">
          Mis Finanzas
        </a>
      </li>
      <li>
        <a href="documentos_matriculate.php" class="nav-btn <?php echo $currentPage == 'documentos_matriculate.php' ? 'active' : ''; ?>">
          Mis Documentos
        </a>
      </li>
      <li class="nav-dropdown">
        <a href="aula-virtual_matriculate.php" class="nav-btn">
          Aula Virtual <i class="fas fa-caret-down"></i>
        </a>
        <ul class="dropdown-content">
          <li><a href="https://bolivarianovirtual.com/login/index.php">Acceder</a></li>
        </ul>
      </li>
      <li>
        <a href="tramites_matriculate.php" class="nav-btn <?php echo $currentPage == 'tramites_matriculate.php' ? 'active' : ''; ?>">
          Trámites en Línea IUBS
        </a>
      </li>
      <li>
        <a href="institucionales.php" class="nav-btn <?php echo $currentPage == 'institucionales.php' ? 'active' : ''; ?>">
          Reglamentos/Misión/Visión
        </a>
      </li>
    </ul>
  </nav>

<?php
// El contenido de la página irá después de incluir este nav
?>