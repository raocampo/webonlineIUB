<?php
require_once 'conexion.php';
require_once 'security-helper.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpiar datos de entrada
    $nombres = SecurityHelper::cleanInput($_POST['nombres']);
    $identificacion = SecurityHelper::cleanInput($_POST['identificacion']);
    $nmr_tel = SecurityHelper::cleanInput($_POST['nmr_tel']);
    $fch_nac = SecurityHelper::cleanInput($_POST['fch_nac']);
    $direccion = SecurityHelper::cleanInput($_POST['direccion']);
    $est_cvl = SecurityHelper::cleanInput($_POST['est_cvl']);
    $ciudad = SecurityHelper::cleanInput($_POST['ciudad']);
    $pais = SecurityHelper::cleanInput($_POST['pais']);

    // Obtener nombre de usuario de la sesión
    if (isset($_SESSION['usuario'])) {
        $usuario_nombre = $_SESSION['usuario'];

        // Actualizar datos personales en la base de datos
        try {
            $sql = "UPDATE usu_dts SET nombres=:nombres, identificacion=:identificacion, nmr_tel=:nmr_tel, fch_nac=:fch_nac, direccion=:direccion, est_cvl=:est_cvl, ciudad=:ciudad, pais=:pais WHERE usuario=:usuario";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
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
            
            if ($result) {
                // Registrar actividad
                SecurityHelper::logActivity($usuario_nombre, 'update_profile', 'Actualización de datos personales', $pdo);
                
                echo '
                    <script>
                        alert("Datos actualizados exitosamente");
                        window.location = "../perfil-matriculate.php";
                    </script>
                ';
                exit();
            } else {
                echo '
                    <script>
                        alert("Error al actualizar los datos");
                        window.location = "../perfil-matriculate.php";
                    </script>
                ';
                exit();
            }
        } catch (PDOException $e) {
            error_log("Error actualizando datos personales: " . $e->getMessage());
            echo '
                <script>
                    alert("Error del sistema. Por favor intente más tarde.");
                    window.location = "../perfil-matriculate.php";
                </script>
            ';
            exit();
        }
    } else {
        echo '
            <script>
                alert("No ha iniciado sesión");
                window.location = "../matriculate-online.php";
            </script>
        ';
        exit();
    }
}
?>