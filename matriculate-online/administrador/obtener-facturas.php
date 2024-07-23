<?php
require_once '../php-bd/conexion.php';

try {
    // Preparar la consulta SQL para obtener todas las facturas
    $sql = "SELECT * FROM facturas";
    $stmt = $pdo->query($sql);
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>