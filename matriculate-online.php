<?php
declare(strict_types=1);
session_start();

// Si ya está autenticado, redirigir al dashboard
if (!empty($_SESSION['usuario'])) {
    header('Location: /matriculate-online/inicio_matriculate.php');
    exit;
}

// Capturar y limpiar error de login
$loginError = '';
if (!empty($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sistema de matrícula online del Instituto Universitario Bolivariano">
  <title>Matricúlate Online - Instituto Bolivariano</title>
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/iconos/icono-32x32.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/style.css">
  <style>
    .login-page {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: linear-gradient(135deg, #1D327B 0%, #0d1b42 100%);
    }
    .login-header {
      padding: 1.5rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .login-header img { height: 50px; width: auto; }
    .login-main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }
    .login-card {
      background: #fff;
      border-radius: 16px;
      padding: 2.5rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .login-card__logo { text-align: center; margin-bottom: 1.5rem; }
    .login-card__logo img { height: 60px; width: auto; margin: 0 auto; }
    .login-card h1 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1D327B;
      text-align: center;
      margin-bottom: 0.25rem;
    }
    .login-card__subtitle {
      text-align: center;
      color: #6c757d;
      font-size: 0.9rem;
      margin-bottom: 1.75rem;
    }
    .form-label { font-weight: 600; color: #333; font-size: 0.9rem; }
    .form-control {
      border-radius: 8px;
      border: 1.5px solid #dee2e6;
      padding: 0.65rem 1rem;
      font-size: 0.95rem;
    }
    .form-control:focus {
      border-color: #1D327B;
      box-shadow: 0 0 0 3px rgba(29,50,123,0.15);
    }
    .input-group-text {
      background: transparent;
      border: 1.5px solid #dee2e6;
      border-left: none;
      cursor: pointer;
      border-radius: 0 8px 8px 0;
    }
    .btn-login {
      background-color: #1D327B;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.75rem;
      font-size: 1rem;
      font-weight: 600;
      width: 100%;
      transition: background-color 0.2s;
      margin-top: 0.5rem;
      cursor: pointer;
    }
    .btn-login:hover { background-color: #152459; }
    .alert-login-error {
      background: #fff3cd;
      border: 1.5px solid #ffc107;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      color: #664d03;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    .login-footer {
      text-align: center;
      padding: 1.5rem;
      color: rgba(255,255,255,0.6);
      font-size: 0.8rem;
    }
    .login-footer a { color: rgba(255,255,255,0.8); text-decoration: none; }
    .login-footer a:hover { color: #fff; }
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      color: rgba(255,255,255,0.8);
      font-size: 0.875rem;
      text-decoration: none;
      border: 1px solid rgba(255,255,255,0.3);
      padding: 0.35rem 0.8rem;
      border-radius: 20px;
      transition: all 0.2s;
    }
    .back-link:hover {
      color: #fff;
      border-color: rgba(255,255,255,0.6);
      background: rgba(255,255,255,0.1);
    }
  </style>
</head>
<body>

<div class="login-page">
  <header class="login-header">
    <img src="/assets/images/logos/BolOnline.png" alt="Bolivariano Online">
    <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
  </header>

  <main class="login-main">
    <div class="login-card">
      <div class="login-card__logo">
        <img src="/assets/images/logos/Bolivariano.png" alt="Instituto Universitario Bolivariano">
      </div>
      <h1>Bienvenido</h1>
      <p class="login-card__subtitle">Ingresa a tu portal estudiantil</p>

      <?php if ($loginError): ?>
      <div class="alert-login-error" role="alert">
        <i class="fas fa-exclamation-triangle"></i>
        <?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
      </div>
      <?php endif; ?>

      <form id="loginForm" method="post" action="matriculate-online/php-bd/login.php" novalidate>
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="usuario" name="usuario"
                 placeholder="Tu nombre de usuario" required autocomplete="username" autofocus>
        </div>
        <div class="mb-3">
          <label for="contrasena" class="form-label">Contraseña</label>
          <div class="input-group">
            <input type="password" class="form-control" id="contrasena" name="contrasena"
                   placeholder="Tu contraseña" required autocomplete="current-password"
                   style="border-radius: 8px 0 0 8px; border-right: none;">
            <span class="input-group-text" onclick="togglePassword()" title="Mostrar/ocultar contraseña">
              <i class="fas fa-eye" id="eyeIcon"></i>
            </span>
          </div>
        </div>
        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
      </form>
    </div>
  </main>

  <footer class="login-footer">
    <p>&copy; <?= date('Y') ?> Instituto Superior Universitario Bolivariano &mdash;
       <a href="mailto:info@tbolivariano.edu.ec">info@tbolivariano.edu.ec</a>
    </p>
  </footer>
</div>

<script>
  function togglePassword() {
    const input = document.getElementById('contrasena');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  }
</script>

</body>
</html>
