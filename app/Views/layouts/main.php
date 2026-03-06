<?php

declare(strict_types=1);
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Robert Ocampo (R@0/CorpSimtelec)">
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'Instituto Superior Universitario Bolivariano Online', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://bolivarianovirtual.com/">

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/iconos/icono-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/iconos/icono-32x32.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/toast.css">
    <link rel="stylesheet" href="/css/form-validation.css">
    <link rel="stylesheet" href="/css/loading-states.css">
    <link rel="stylesheet" href="/css/dark-mode.css">
    <link rel="stylesheet" href="/css/mvc-enhancements.css">

    <title><?= htmlspecialchars($title ?? 'Instituto Superior Universitario Bolivariano Online', ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable">Saltar al contenido principal</a>
<div class="ux-topbar" role="status" aria-live="polite">Admisiones abiertas 2026 · Educación 100% online · Soporte académico permanente</div>
<main id="main-content" class="ux-page-shell">
<?= $content ?>
</main>
<button id="ux-backtop" class="ux-backtop" aria-label="Volver arriba" title="Volver arriba"><i class="bi bi-arrow-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/js/toast.js"></script>
<script src="/js/form-validator.js"></script>
<script src="/js/loading-states.js"></script>
<script src="/js/theme-toggle.js"></script>
<script src="/js/main.js"></script>
<script src="/js/mvc-enhancements.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const registroForm = document.getElementById('registroForm');
    if (registroForm && typeof FormValidator !== 'undefined') {
        const validator = new FormValidator(registroForm);
        validator
            .addRules('nombre', ['required'])
            .addRules('apellido', ['required'])
            .addRules('correo', ValidationRules.email)
            .addRules('cedula', ValidationRules.cedula)
            .addRules('telefono', ValidationRules.phone)
            .addRules('tipoEstudio', ['required']);
    }
});
</script>
</body>
</html>
