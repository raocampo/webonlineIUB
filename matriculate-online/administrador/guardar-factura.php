<?php
// Incluir archivo de conexión a la base de datos
require_once '../php-bd/conexion.php';

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $nro_cmp = htmlspecialchars(trim($_POST['nro_cmp']));
    $fch_pag = htmlspecialchars(trim($_POST['fch_pag']));
    $vlr_fct = htmlspecialchars(trim($_POST['vlr_fct']));

    try {
        // Preparar la consulta SQL para insertar en la tabla usuario usando PDO
        $sql = "INSERT INTO facturas (usuario, nro_cmp, fch_pag, vlr_fct) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario, $nro_cmp, $fch_pag, $vlr_fct]);

        echo '
                <script>
                    alert("Factura registrada correctamente");
                    window.location = "inicio-admin.php";
                </script>
            ';
    } catch (PDOException $e) {

        echo '
                <script>
                    alert("Problemas al registrar factura" . $e->getMessage(););
                    window.location = "inicio-admin.php";
                </script>
            ';
    }
}
?>