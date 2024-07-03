<?php
include 'conexion.php';

$usuario_id = 1;

$sql = "SELECT * FROM users WHERE id = $usuario_id";
$result = $conn->query($sql);

$usuario = null;

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "0 resultados";
}

$conn->close();
?>
