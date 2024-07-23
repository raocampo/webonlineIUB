<?php
session_start();
require_once '../php-bd/conexion.php';

try {
    // Obtener el usuario logueado desde la sesión
    $usuario = $_SESSION['usuario'];

    // Preparar la consulta SQL para obtener las facturas del usuario logueado
    $sql = "SELECT * FROM facturas WHERE usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario]);
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>