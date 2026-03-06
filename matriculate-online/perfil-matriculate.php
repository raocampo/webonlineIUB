<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil - Matricúlate Online | Instituto Bolivariano</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../css/toast.css">
  <link rel="stylesheet" href="../css/file-upload.css">
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
      <div class="card datos-personales" id="datos-personales">
        <h2><i class="fas fa-user-edit"></i> Datos Personales</h2>
        <form action="php-bd/actualizar_datosP.php" method="POST">
          <?php echo SecurityHelper::csrfField(); ?>
          <div class="data-rowX">
            <div class="left-column">
              <div class="profile-photo-container">
                <?php
                $fotoUrl = !empty($usuario['foto_perfil']) ? '../' . $usuario['foto_perfil'] : '../assets/images/matriculaOnline/avatarUser.png';
                ?>
                <img src="<?php echo esc($fotoUrl); ?>" alt="Foto de Perfil" class="profile-photo" id="profilePhoto">
                <button type="button" class="profile-photo-upload" onclick="document.getElementById('photoInput').click()" title="Cambiar foto de perfil">
                  <i class="fas fa-camera"></i>
                </button>
                <input type="file" id="photoInput" accept="image/jpeg,image/png" style="display: none;">
              </div>
              <span class="label" style="text-align: center; display: block; margin-top: 10px;">
                <?php echo esc($usuario['nombres'] . ' ' . $usuario['apellidos']); ?>
              </span>
            </div>
            <div class="center-column">
              <div class="data-row">
                <span class="label">Nombres:</span>
                <input type="text" class="value" name="nombres" value="<?php echo esc($usuario['nombres']); ?>" required>
              </div>
              <div class="data-row">
                <span class="label">Identificación:</span>
                <input type="text" class="value" name="identificacion" value="<?php echo esc($usuario['identificacion']); ?>" maxlength="13">
              </div>
              <div class="data-row">
                <span class="label">Nro. de teléfono:</span>
                <input type="tel" class="value" name="nmr_tel" value="<?php echo esc($usuario['nmr_tel']); ?>">
              </div>
              <div class="data-row">
                <span class="label">Fecha nacimiento:</span>
                <input type="date" class="value" name="fch_nac" value="<?php echo esc($usuario['fch_nac']); ?>">
              </div>
            </div>
            <div class="right-column">
              <div class="data-row">
                <span class="label">Dirección:</span>
                <input type="text" class="value" name="direccion" value="<?php echo esc($usuario['direccion']); ?>">
              </div>
              <div class="data-row">
                <span class="label">Estado Civil:</span>
                <select class="value" name="est_cvl">
                  <option value="">Seleccionar...</option>
                  <?php
                  $estadosCiviles = ['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a', 'Unión Libre'];
                  foreach ($estadosCiviles as $estado) {
                    $selected = ($usuario['est_cvl'] === $estado) ? 'selected' : '';
                    echo '<option value="' . esc($estado) . '" ' . $selected . '>' . esc($estado) . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="data-row">
                <span class="label">Ciudad:</span>
                <input type="text" class="value" name="ciudad" value="<?php echo esc($usuario['ciudad']); ?>">
              </div>
              <div class="data-row">
                <span class="label">País:</span>
                <input type="text" class="value" name="pais" value="<?php echo esc($usuario['pais']); ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn-guardar"><i class="fas fa-save"></i> Guardar Cambios</button>
        </form>
      </div>

      <div class="card domicilios" id="domicilios">
        <h2><i class="fas fa-home"></i> Domicilios</h2>
        <form action="php-bd/actualizar_domicilios.php" method="POST">
          <?php echo SecurityHelper::csrfField(); ?>
          <div class="data-rowX">
            <div class="left-column">
              <div class="data-row">
                <span class="label">Calle Principal:</span>
                <input type="text" class="value" name="cll_prn" value="<?php echo esc($usuario_dmc['cll_prn'] ?? ''); ?>">
              </div>
              <div class="data-row">
                <span class="label">Calle Secundaria:</span>
                <input type="text" class="value" name="cll_scn" value="<?php echo esc($usuario_dmc['cll_scn'] ?? ''); ?>">
              </div>
              <div class="data-row">
                <span class="label">Ciudad:</span>
                <input type="text" class="value" name="ciudad" value="<?php echo esc($usuario['ciudad'] ?? ''); ?>">
              </div>
              <div class="data-row">
                <span class="label">País:</span>
                <input type="text" class="value" name="pais" value="<?php echo esc($usuario['pais'] ?? ''); ?>">
              </div>
            </div>
            <div class="right-column">
              <div class="data-row">
                <span class="label">Provincia:</span>
                <input type="text" class="value" name="provincia" value="<?php echo esc($usuario['provincia'] ?? ''); ?>">
              </div>
              <div class="data-row">
                <span class="label">Código Postal:</span>
                <input type="text" class="value" name="cdg_pst" value="<?php echo esc($usuario_dmc['cdg_pst'] ?? ''); ?>" maxlength="10">
              </div>
              <div class="data-row">
                <span class="label">Teléfono de contacto:</span>
                <input type="tel" class="value" name="tlf_cnt" value="<?php echo esc($usuario_dmc['tlf_cnt'] ?? ''); ?>">
              </div>
              <div class="data-row">
                <span class="label">Referencia:</span>
                <input type="text" class="value" name="referencia" value="<?php echo esc($usuario_dmc['referencia'] ?? ''); ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn-guardar"><i class="fas fa-save"></i> Guardar Domicilio</button>
        </form>
      </div>

    </div>
  </main>

  <script src="../js/toast.js"></script>
  <script src="../js/file-uploader.js"></script>
  <script>
    const photoUploader = new FileUploader({
      maxSize: 5 * 1024 * 1024,
      allowedExtensions: ['jpg', 'jpeg', 'png'],
      allowedMimes: ['image/jpeg', 'image/png'],
      onError: (message) => Toast.error(message)
    });

    const photoInput = document.getElementById('photoInput');
    photoUploader.initInput(photoInput);

    photoInput.addEventListener('change', async function(e) {
      const file = e.target.files[0];
      if (!file) return;

      const validation = photoUploader.validateFile(file);
      if (!validation.valid) {
        Toast.error(validation.error);
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profilePhoto').src = e.target.result;
      };
      reader.readAsDataURL(file);

      const csrfToken = '<?php echo SecurityHelper::generateCsrfToken(); ?>';

      try {
        Toast.info('Subiendo foto de perfil...');
        const formData = new FormData();
        formData.append('file', file);
        formData.append('csrf_token', csrfToken);

        const response = await fetch('php-bd/upload-profile-photo.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          Toast.success(result.message || 'Foto actualizada correctamente');
        } else {
          Toast.error(result.message || 'Error al actualizar la foto');
          document.getElementById('profilePhoto').src = '<?php echo esc($fotoUrl); ?>';
        }
      } catch (error) {
        Toast.error('Error al subir la foto');
        document.getElementById('profilePhoto').src = '<?php echo esc($fotoUrl); ?>';
      }
    });
  </script>

</body>

</html>
