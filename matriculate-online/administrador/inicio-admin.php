<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Eric Alvarado">
    <title>Matriculate Online - Instituto Bolivariano</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Asegúrate de incluir Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

<body>

    <header class="header">
        <?php include '../php-bd/obtener_datos.php'; ?>
        <div class="logo-container">
            <img src="../../assets/images/logos/BolOnline.png" alt="Logo Instituto Bolivariano">
        </div>
        <div class="user-info">
            <div class="user-details">
                <span class="user-welcome">Bienvenido <?php echo htmlspecialchars($usuario['usuario']); ?></span>
                <form action="logout-admin.php" method="post" style="display:inline;">
                    <button class="logout-btn" type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </header>

    <nav class="navigation">
        <ul class="menu">
            <li><a href="inicio-admin.php" class="nav-btn">Inicio</a></li>
            <li><a href="perfil-admin.php" class="nav-btn">Perfil</a></li>
            <li><a href="facturas-admin.php" class="nav-btn">Facturas</a></li>
            <li><a href="usuarios-admin.php" class="nav-btn">Usuarios</a></li>
        </ul>
    </nav>

    <main class="content">
        <div class="column">
            <div class="column">
                <div class="card">

                    <h2>Registro de Alumnos</h2>
                    <form id="formulario" method="post" action="guardar.php">
                        <div class="left-column">
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" id="nombres" name="nombres" placeholder="Ingrese los nombres"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="identificacion">Identificación:</label>
                                <input type="text" id="identificacion" name="identificacion"
                                    placeholder="Ingrese la identificación" required>
                            </div>
                            <div class="form-group">
                                <label for="nmr_tel">Teléfono:</label>
                                <input type="text" id="nmr_tel" name="nmr_tel" placeholder="Ingrese el teléfono"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="fch_nac">Fecha de Nacimiento:</label>
                                <input type="date" id="fch_nac" name="fch_nac" required>
                            </div>
                            <div class="form-group">
                                <label for="est_cvl">Estado Civil:</label>
                                <input type="text" id="est_cvl" name="est_cvl" placeholder="Ingrese el estado civil"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="pais">País:</label>
                                <input type="text" id="pais" name="pais" placeholder="Ingrese el país" required>
                            </div>

                        </div>

                        <div class="right-column">
                            <div class="form-group">
                                <label for="provincia">Provincia:</label>
                                <input type="text" id="provincia" name="provincia" placeholder="Ingrese la provincia"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" id="ciudad" name="ciudad" placeholder="Ingrese la ciudad" required>
                            </div>
                            <div class="form-group">
                                <label for="carrera">Carrera:</label>
                                <input type="text" id="carrera" name="carrera" placeholder="Ingrese la carrera"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Ingrese el usuario"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" id="correo" name="correo" placeholder="Ingrese el correo" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña:</label>
                                <input type="text" id="contrasena" name="contrasena" placeholder="Ingrese la contraseña"
                                    required readonly>
                                <button type="button" id="generar-contrasena">Generar contraseña</button>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <input type="text" id="tipo" name="tipo" value="E" readonly>
                            </div>

                        </div>

                        <div class="button-container">
                            <button type="submit" class="guardar-btn">Guardar</button>
                        </div>
                    </form>


                </div>
                <div class="column">
                    <div class="card">
                        <h2>Registro de pagos</h2>
                        <div class="data-rowX">
                            <form id="formulario" method="post" action="guardar-factura.php">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese el usuario"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="nro_cmp">Número de comprobante:</label>
                                    <input type="text" id="nro_cmp" name="nro_cmp"
                                        placeholder="Ingrese el número de comprobante" required>
                                </div>
                                <div class="form-group">
                                    <label for="fch_pag">Fecha de pago:</label>
                                    <input type="date" id="fch_pag" name="fch_pag"
                                        placeholder="Ingrese la fecha del pago" required>
                                </div>
                                <div class="form-group">
                                    <label for="vlr_fct">Valor:</label>
                                    <input type="number" id="vlr_fct" name="vlr_fct"
                                        placeholder="Ingrese el valor del pago" step="0.01" required>
                                </div>
                                <div class="button-container">
                                    <button type="submit" class="guardar-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <script>
        // Función para generar una contraseña aleatoria de longitud especificada
        function generarContrasena(longitud) {
            const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+~`|}{[]\:;?><,./-=';
            let contrasena = '';

            for (let i = 0; i < longitud; i++) {
                const caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
                contrasena += caracterAleatorio;
            }

            return contrasena;
        }

        // Asignar evento clic al botón "Generar contraseña"
        document.getElementById('generar-contrasena').addEventListener('click', function () {
            const contrasenaInput = document.getElementById('contrasena');
            const nuevaContrasena = generarContrasena(8); // Generar contraseña de 8 caracteres
            contrasenaInput.value = nuevaContrasena;
        });
    </script>

</body>

</html>