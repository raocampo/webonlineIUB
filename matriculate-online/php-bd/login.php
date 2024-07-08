<?php
session_start();
require 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

try {
    // Preparar la consulta SQL
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($query);

    // Ejecutar la consulta
    $stmt->execute(['usuario' => $usuario]);

    // Obtener el resultado
    $user = $stmt->fetch();

    if ($user && password_verify($contrasena, $user['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../inicio_matriculate.php");
        exit;
    } else {
        echo '
            <script>
                alert("Usuario o contraseña incorrectos");
                window.location = "../matriculate-online.php";
            </script>
        ';
        exit;
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>