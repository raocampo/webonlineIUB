<?php
require 'conexion.php';

try {
    $stmt = $pdo->prepare("SELECT nombre FROM carreras");
    $stmt->execute();

    $carreras = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($carreras);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>