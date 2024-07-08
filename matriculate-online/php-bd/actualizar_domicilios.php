<?php
include 'conexion.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $cll_prn = $_POST['cll_prn'];
    $cll_scn = $_POST['cll_scn'];
    $cdg_pst = $_POST['cdg_pst'];
    $tlf_cnt = $_POST['tlf_cnt'];
    $referencia = $_POST['referencia'];

    // Obtener nombre de usuario de la sesión
    if (isset($_SESSION['usuario'])) {
        $usuario_nombre = $_SESSION['usuario'];

        // Actualizar domicilios en la base de datos
        try {
            $sql_dmc = "UPDATE usu_dmc SET cll_prn=:cll_prn, cll_scn=:cll_scn, cdg_pst=:cdg_pst, tlf_cnt=:tlf_cnt, referencia=:referencia WHERE usuario=:usuario";
            $stmt_dmc = $pdo->prepare($sql_dmc);
            $stmt_dmc->execute([
                ':cll_prn' => $cll_prn,
                ':cll_scn' => $cll_scn,
                ':cdg_pst' => $cdg_pst,
                ':tlf_cnt' => $tlf_cnt,
                ':referencia' => $referencia,
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
            echo "Error actualizando domicilios: " . $e->getMessage();
        }
    } else {
        echo "No has iniciado sesión";
    }
}
?>