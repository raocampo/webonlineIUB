<?php
// Incluir archivo de conexión a la base de datos
require_once '../php-bd/conexion.php';

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $correo = htmlspecialchars(trim($_POST['correo']));
    $contrasena = htmlspecialchars(trim($_POST['contrasena']));
    $tipo = htmlspecialchars(trim($_POST['tipo']));
    $nombres = htmlspecialchars(trim($_POST['nombres']));
    $identificacion = htmlspecialchars(trim($_POST['identificacion']));
    $nmr_tel = htmlspecialchars(trim($_POST['nmr_tel']));
    $fch_nac = htmlspecialchars(trim($_POST['fch_nac']));
    $est_cvl = htmlspecialchars(trim($_POST['est_cvl']));
    $direccion = htmlspecialchars(trim($_POST['direccion']));
    $pais = htmlspecialchars(trim($_POST['pais']));
    $provincia = htmlspecialchars(trim($_POST['provincia']));
    $ciudad = htmlspecialchars(trim($_POST['ciudad']));
    $carrera = htmlspecialchars(trim($_POST['carrera']));


    // Hashear la contraseña antes de almacenarla en la base de datos
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        // Preparar la consulta SQL para insertar en la tabla usuario usando PDO
        $sql = "INSERT INTO usuarios (usuario, correo, contrasena, tipo, nro_matricula, nombres, identificacion,
        nmr_tel, fch_nac, est_cvl, direccion, pais, provincia, ciudad, carrera ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $usuario,
            $correo,
            $hashed_password,
            $tipo,
            $identificacion,
            $nombres,
            $identificacion,
            $nmr_tel,
            $fch_nac,
            $est_cvl,
            $direccion,
            $pais,
            $provincia,
            $ciudad,
            $carrera
        ]);

        echo '
                <script>
                    alert("Usuario registrado correctamente");
                    window.location = "inicio-admin.php";
                </script>
            ';
    } catch (PDOException $e) {

        echo '
                <script>
                    alert("Problemas al registrar usuario" . $e->getMessage(););
                    window.location = "inicio-admin.php";
                </script>
            ';
    }
}
?>