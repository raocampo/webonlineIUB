<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Eric Alvarado">
    <title>Matriculate Online - Instituto Bolivariano</title>
    <link rel="stylesheet" href="../css/style.css">
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
            <div class="card">
                <h2>Facturas Registradas</h2>
                <div class="data-rowX">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Número de Comprobante</th>
                                <th>Fecha de Pago</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Incluir el archivo que obtiene las facturas
                            include 'obtener-facturas.php';

                            // Iterar sobre cada factura y crear una fila en la tabla
                            foreach ($facturas as $factura) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($factura['usuario']) . "</td>";
                                echo "<td>" . htmlspecialchars($factura['nro_cmp']) . "</td>";
                                echo "<td>" . htmlspecialchars($factura['fch_pag']) . "</td>";
                                echo "<td>" . htmlspecialchars($factura['vlr_fct']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>

</html>