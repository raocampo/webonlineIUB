<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Preparar la consulta SQL
$query = "SELECT * FROM users WHERE usuario = ? AND contrasena = ?";
$stmt = $conn->prepare($query);

// Enlazar los parámetros
$stmt->bind_param("ss", $usuario, $contrasena);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    header("Location: inicio_matriculate.php");
    exit;
} else {
    echo '
        <script>
            alert("Usuario no existe");
            window.location = "../matriculate-online.php";
        </script>
    ';
    exit;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>