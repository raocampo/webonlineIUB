<?php
require_once '../php-bd/conexion.php';

try {
    // Preparar la consulta SQL para obtener todos los usuarios
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>