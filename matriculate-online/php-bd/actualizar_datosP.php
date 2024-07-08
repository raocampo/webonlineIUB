<?php
include 'conexion.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombres = $_POST['nombres'];
    $identificacion = $_POST['identificacion'];
    $nmr_tel = $_POST['nmr_tel'];
    $fch_nac = $_POST['fch_nac'];
    $direccion = $_POST['direccion'];
    $est_cvl = $_POST['est_cvl'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];

    // Obtener nombre de usuario de la sesión
    if (isset($_SESSION['usuario'])) {
        $usuario_nombre = $_SESSION['usuario'];

        // Actualizar datos personales en la base de datos
        try {
            $sql = "UPDATE usu_dts SET nombres=:nombres, identificacion=:identificacion, nmr_tel=:nmr_tel, fch_nac=:fch_nac, direccion=:direccion, est_cvl=:est_cvl, ciudad=:ciudad, pais=:pais WHERE usuario=:usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombres' => $nombres,
                ':identificacion' => $identificacion,
                ':nmr_tel' => $nmr_tel,
                ':fch_nac' => $fch_nac,
                ':direccion' => $direccion,
                ':est_cvl' => $est_cvl,
                ':ciudad' => $ciudad,
                ':pais' => $pais,
                ':usuario' => $usuario_nombre
            ]);
            echo '
                <script>
                    alert("Usuario o contraseña incorrectos");
                    window.location = "../matriculate-online.php";
                </script>
            ';
            header("Location: ../perfil-matriculate.php");
            exit();
        } catch (PDOException $e) {
            echo "Error actualizando datos personales: " . $e->getMessage();
        }
    } else {
        echo "No has iniciado sesión";
    }
}
?>